<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BookingController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Auth::user()->isAdmin() 
            ? Booking::with(['user', 'service'])->latest()->paginate(10)
            : Auth::user()->bookings()->with('service')->latest()->paginate(10);

        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $service = Service::findOrFail($request->service);
        if (!$service->is_available) {
            return redirect()->back()->with('error', 'Layanan ini sedang tidak tersedia.');
        }
        return view('bookings.create', compact('service'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date|after:today',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string|max:500',
        ]);

        $service = Service::findOrFail($validated['service_id']);
        
        // Check if service is available
        if (!$service->is_available) {
            return redirect()->back()
                ->with('error', 'Layanan ini sedang tidak tersedia.')
                ->withInput();
        }

        // Check capacity availability for the selected date
        $existingBookings = Booking::where('service_id', $service->id)
            ->where('booking_date', $validated['booking_date'])
            ->where('status', '!=', 'cancelled')
            ->sum('quantity');

        $remainingCapacity = $service->capacity - $existingBookings;

        if ($validated['quantity'] > $remainingCapacity) {
            return redirect()->back()
                ->with('error', "Kapasitas tidak mencukupi. Sisa kapasitas: {$remainingCapacity}")
                ->withInput();
        }

        try {
            DB::beginTransaction();
            
            $validated['user_id'] = Auth::id();
            $validated['total_price'] = $service->price * $validated['quantity'];
            $validated['status'] = 'pending';

            Booking::create($validated);
            
            DB::commit();

            return redirect()->route('bookings.index')
                ->with('success', 'Pemesanan berhasil dibuat dan menunggu konfirmasi.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan. Silakan coba lagi.')
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        $this->authorize('view', $booking);
        return view('bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        $this->authorize('update', $booking);
        
        if ($booking->status !== 'pending') {
            return redirect()->route('bookings.show', $booking)
                ->with('error', 'Hanya pemesanan dengan status pending yang dapat diubah.');
        }

        return view('bookings.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $this->authorize('update', $booking);
        
        if (Auth::user()->isAdmin()) {
            $validated = $request->validate([
                'status' => 'required|in:pending,confirmed,cancelled',
            ]);
        } else {
            if ($booking->status !== 'pending') {
                return redirect()->back()
                    ->with('error', 'Hanya pemesanan dengan status pending yang dapat diubah.');
            }

            $validated = $request->validate([
                'quantity' => 'required|integer|min:1',
                'notes' => 'nullable|string|max:500',
            ]);

            // Recalculate total price if quantity changed
            if (isset($validated['quantity']) && $validated['quantity'] !== $booking->quantity) {
                $validated['total_price'] = $booking->service->price * $validated['quantity'];
            }
        }

        $booking->update($validated);

        return redirect()->route('bookings.show', $booking)
            ->with('success', 'Pemesanan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $this->authorize('delete', $booking);
        
        if ($booking->status === 'confirmed') {
            return redirect()->back()
                ->with('error', 'Pemesanan yang sudah dikonfirmasi tidak dapat dihapus.');
        }
        
        $booking->delete();

        return redirect()->route('bookings.index')
            ->with('success', 'Pemesanan berhasil dihapus.');
    }
}
