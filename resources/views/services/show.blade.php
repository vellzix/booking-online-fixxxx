<x-app-layout>
    <div class="bg-white">
        <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
            <div class="lg:grid lg:grid-cols-2 lg:gap-x-8 lg:items-start">
                <!-- Image gallery -->
                <div class="flex flex-col">
                    <div class="w-full aspect-w-1 aspect-h-1 bg-gray-200 rounded-lg overflow-hidden">
                        @if($service->image)
                            <img src="{{ Storage::url($service->image) }}" alt="{{ $service->name }}" class="w-full h-full object-center object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <i class="fas {{ $service->category->icon }} text-6xl text-gray-400"></i>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Service info -->
                <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
                    <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">{{ $service->name }}</h1>

                    <div class="mt-3">
                        <h2 class="sr-only">Service information</h2>
                        <p class="text-3xl text-gray-900">Rp {{ number_format($service->price, 0, ',', '.') }}</p>
                    </div>

                    <div class="mt-6">
                        <h3 class="sr-only">Description</h3>
                        <div class="text-base text-gray-700 space-y-6">
                            <p>{{ $service->description }}</p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <div class="flex items-center">
                            <i class="fas fa-users text-gray-500 mr-2"></i>
                            <p class="text-sm text-gray-500">Kapasitas: {{ $service->capacity }} orang</p>
                        </div>
                        <div class="mt-2 flex items-center">
                            <i class="fas {{ $service->category->icon }} text-gray-500 mr-2"></i>
                            <p class="text-sm text-gray-500">Kategori: {{ $service->category->name }}</p>
                        </div>
                    </div>

                    <div class="mt-8 flex flex-col space-y-4">
                        @auth
                            @if($service->is_available)
                                <a href="{{ route('bookings.create', ['service' => $service->id]) }}" class="w-full bg-orange-500 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-orange-50 hover:bg-orange-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition duration-150 ease-in-out">
                                    Pesan Sekarang
                                </a>
                            @else
                                <button disabled class="w-full bg-gray-300 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white cursor-not-allowed">
                                    Tidak Tersedia
                                </button>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="w-full bg-teal-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-teal-50 hover:bg-teal-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition duration-150 ease-in-out">
                                Login untuk Memesan
                            </a>
                        @endauth

                        @auth
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('services.edit', $service) }}" class="w-full bg-white border border-gray-300 rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Edit Layanan
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 