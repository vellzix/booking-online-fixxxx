<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="pb-5 border-b border-gray-200">
            <h1 class="text-3xl font-bold leading-tight text-gray-900">
                {{ auth()->user()->isAdmin() ? 'Semua Pemesanan' : 'Pemesanan Saya' }}
            </h1>
        </div>

        <div class="mt-8">
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Layanan
                                        </th>
                                        @if(auth()->user()->isAdmin())
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Pemesan
                                            </th>
                                        @endif
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tanggal
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Jumlah
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Total
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($bookings as $booking)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        @if($booking->service->image)
                                                            <img class="h-10 w-10 rounded-full object-cover" src="{{ Storage::url($booking->service->image) }}" alt="{{ $booking->service->name }}">
                                                        @else
                                                            <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                                                <i class="fas {{ $booking->service->category->icon }} text-gray-400"></i>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $booking->service->name }}
                                                        </div>
                                                        <div class="text-sm text-gray-500">
                                                            {{ $booking->service->category->name }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            @if(auth()->user()->isAdmin())
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $booking->user->name }}</div>
                                                    <div class="text-sm text-gray-500">{{ $booking->user->email }}</div>
                                                </td>
                                            @endif
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $booking->booking_date->format('d M Y') }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $booking->quantity }} orang
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @php
                                                    $statusClasses = [
                                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                                        'confirmed' => 'bg-green-100 text-green-800',
                                                        'cancelled' => 'bg-red-100 text-red-800',
                                                    ];
                                                    $statusLabels = [
                                                        'pending' => 'Menunggu',
                                                        'confirmed' => 'Dikonfirmasi',
                                                        'cancelled' => 'Dibatalkan',
                                                    ];
                                                @endphp
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClasses[$booking->status] }}">
                                                    {{ $statusLabels[$booking->status] }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <div class="flex justify-end space-x-3">
                                                    <a href="{{ route('bookings.show', $booking) }}" class="text-indigo-600 hover:text-indigo-900">Detail</a>
                                                    @if(auth()->user()->isAdmin())
                                                        <form action="{{ route('bookings.update', $booking) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('PUT')
                                                            @if($booking->status === 'pending')
                                                                <input type="hidden" name="status" value="confirmed">
                                                                <button type="submit" class="text-green-600 hover:text-green-900">Konfirmasi</button>
                                                            @endif
                                                        </form>
                                                    @endif
                                                    @can('delete', $booking)
                                                        <form action="{{ route('bookings.destroy', $booking) }}" method="POST" class="inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin membatalkan pemesanan ini?')">
                                                                Batalkan
                                                            </button>
                                                        </form>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="{{ auth()->user()->isAdmin() ? 7 : 6 }}" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                                Tidak ada pemesanan yang ditemukan.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $bookings->links() }}
            </div>
        </div>
    </div>
</x-app-layout> 