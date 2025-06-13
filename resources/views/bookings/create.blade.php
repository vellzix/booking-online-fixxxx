<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Buat Pemesanan</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Isi formulir berikut untuk membuat pemesanan baru.
                    </p>
                </div>
            </div>

            <div class="mt-5 md:mt-0 md:col-span-2">
                <form action="{{ route('bookings.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="service_id" value="{{ $service->id }}">
                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                            <!-- Service Details -->
                            <div>
                                <h4 class="text-lg font-medium text-gray-900">Detail Layanan</h4>
                                <div class="mt-4 flex items-center">
                                    <div class="flex-shrink-0 h-16 w-16">
                                        @if($service->image)
                                            <img class="h-16 w-16 rounded-lg object-cover" src="{{ Storage::url($service->image) }}" alt="{{ $service->name }}">
                                        @else
                                            <div class="h-16 w-16 rounded-lg bg-gray-200 flex items-center justify-center">
                                                <i class="fas {{ $service->category->icon }} text-2xl text-gray-400"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <h5 class="text-lg font-medium text-gray-900">{{ $service->name }}</h5>
                                        <p class="text-sm text-gray-500">{{ $service->category->name }}</p>
                                        <p class="mt-1 text-sm text-indigo-600">Rp {{ number_format($service->price, 0, ',', '.') }} / orang</p>
                                    </div>
                                </div>
                            </div>

                            <div class="border-t border-gray-200 pt-6">
                                <div>
                                    <label for="booking_date" class="block text-sm font-medium text-gray-700">Tanggal Pemesanan</label>
                                    <div class="mt-1">
                                        <input type="date" name="booking_date" id="booking_date" value="{{ old('booking_date') }}" required min="{{ date('Y-m-d', strtotime('+1 day')) }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                    @error('booking_date')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mt-6">
                                    <label for="quantity" class="block text-sm font-medium text-gray-700">Jumlah Orang</label>
                                    <div class="mt-1">
                                        <input type="number" name="quantity" id="quantity" value="{{ old('quantity', 1) }}" required min="1" max="{{ $service->capacity }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                    <p class="mt-1 text-sm text-gray-500">Maksimal {{ $service->capacity }} orang</p>
                                    @error('quantity')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mt-6">
                                    <label for="notes" class="block text-sm font-medium text-gray-700">Catatan (Opsional)</label>
                                    <div class="mt-1">
                                        <textarea id="notes" name="notes" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('notes') }}</textarea>
                                    </div>
                                    @error('notes')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 space-x-3">
                            <a href="{{ route('services.show', $service) }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Buat Pemesanan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout> 