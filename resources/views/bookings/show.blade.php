<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Detail Pemesanan</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Informasi lengkap tentang pemesanan.
                    </p>
                </div>
            </div>

            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="shadow sm:rounded-md sm:overflow-hidden">
                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                        <!-- Service Details -->
                        <div>
                            <h4 class="text-lg font-medium text-gray-900">Layanan</h4>
                            <div class="mt-4 flex items-center">
                                <div class="flex-shrink-0 h-16 w-16">
                                    @if($booking->service->image)
                                        <img class="h-16 w-16 rounded-lg object-cover" src="{{ Storage::url($booking->service->image) }}" alt="{{ $booking->service->name }}">
                                    @else
                                        <div class="h-16 w-16 rounded-lg bg-gray-200 flex items-center justify-center">
                                            <i class="fas {{ $booking->service->category->icon }} text-2xl text-gray-400"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <h5 class="text-lg font-medium text-gray-900">{{ $booking->service->name }}</h5>
                                    <p class="text-sm text-gray-500">{{ $booking->service->category->name }}</p>
                                    <p class="mt-1 text-sm text-indigo-600">Rp {{ number_format($booking->service->price, 0, ',', '.') }} / orang</p>
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 pt-6">
                            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                                    <dd class="mt-1">
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
                                    </dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Tanggal Pemesanan</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $booking->booking_date->format('d M Y') }}</dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Jumlah Orang</dt>
                                    <dd class="mt-1 text-sm text-gray-900">{{ $booking->quantity }} orang</dd>
                                </div>

                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Total Harga</dt>
                                    <dd class="mt-1 text-sm text-gray-900">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</dd>
                                </div>

                                @if($booking->notes)
                                    <div class="sm:col-span-2">
                                        <dt class="text-sm font-medium text-gray-500">Catatan</dt>
                                        <dd class="mt-1 text-sm text-gray-900">{{ $booking->notes }}</dd>
                                    </div>
                                @endif

                                @if(auth()->user()->isAdmin())
                                    <div class="sm:col-span-2">
                                        <dt class="text-sm font-medium text-gray-500">Informasi Pemesan</dt>
                                        <dd class="mt-1 text-sm text-gray-900">
                                            <p>{{ $booking->user->name }}</p>
                                            <p class="text-gray-500">{{ $booking->user->email }}</p>
                                        </dd>
                                    </div>
                                @endif
                            </dl>
                        </div>
                    </div>

                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 space-x-3">
                        @if(auth()->user()->isAdmin() && $booking->status === 'pending')
                            <form action="{{ route('bookings.update', $booking) }}" method="POST" class="inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="confirmed">
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    Konfirmasi Pemesanan
                                </button>
                            </form>
                        @endif

                        @can('delete', $booking)
                            <form action="{{ route('bookings.destroy', $booking) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" onclick="return confirm('Apakah Anda yakin ingin membatalkan pemesanan ini?')">
                                    Batalkan Pemesanan
                                </button>
                            </form>
                        @endcan

                        <a href="{{ route('bookings.index') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 