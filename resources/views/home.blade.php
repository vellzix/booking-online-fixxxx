<x-app-layout>
    <!-- Hero Section -->
    <div class="relative bg-white overflow-hidden">
        <img src="{{ asset('image/bromo-dark.jpg') }}" alt="Bromo" class="absolute inset-0 w-full h-full object-cover object-middle z-0 rounded-xl">
        <div class="absolute inset-0 bg-gray-100 bg-opacity-50 z-10 rounded-xl"></div>
        <div class="max-w-7xl mx-auto relative z-20">
            <div class="relative z-20 pb-8 bg-transparent sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                    <div class="sm:text-center lg:text-left">
                        <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
                            <span class="block">Temukan Layanan</span>
                            <span class="block text-orange-500">Terbaik untuk Anda</span>
                        </h1>
                        <p class="mt-3 text-base text-white sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0 drop-shadow-black">
                            Booking tiket pesawat, hotel, travel, dan villa dengan mudah dan aman.
                        </p>
                        <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                            <div class="rounded-md shadow">
                                <a href="{{ route('services.index') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-orange-50 bg-orange-500 hover:bg-orange-400 hover:text-white md:py-4 md:text-lg md:px-10 transition duration-150 ease-in-out">
                                    Lihat Layanan
                                </a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>

    <!-- Categories Section -->
    <div class="bg-gray-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-teal-600 font-semibold tracking-wide uppercase">Kategori</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Pilih Kategori Layanan
                </p>
            </div>

            <div class="mt-10">
                <div class="grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach($categories as $category)
                        <a href="{{ route('categories.show', $category) }}" class="group">
                            <div class="flex flex-col items-center p-6 bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                                <div class="flex items-center justify-center h-16 w-16 rounded-full bg-teal-100 text-teal-600 mb-4">
                                    <i class="fas {{ $category->icon }} text-2xl"></i>
                                </div>
                                <h3 class="text-lg font-medium text-gray-900">{{ $category->name }}</h3>
                                <p class="mt-2 text-sm text-gray-500 text-center">{{ $category->description }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Services Section -->
    <div class="bg-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-orange-500 font-semibold tracking-wide uppercase">Layanan Unggulan</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Layanan Populer
                </p>
            </div>

            <div class="mt-10">
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($featuredServices as $service)
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            @if($service->image)
                                <img class="h-48 w-full object-cover" src="{{ Storage::url($service->image) }}" alt="{{ $service->name }}">
                            @else
                                <div class="h-48 w-full bg-gray-200 flex items-center justify-center">
                                    <i class="fas {{ $service->category->icon }} text-4xl text-gray-400"></i>
                                </div>
                            @endif
                            <div class="px-4 py-5 sm:p-6">
                                <h3 class="text-lg font-medium text-gray-900">
                                    <a href="{{ route('services.show', $service) }}" class="hover:text-teal-600">
                                        {{ $service->name }}
                                    </a>
                                </h3>
                                <p class="mt-1 text-sm text-gray-500">{{ Str::limit($service->description, 100) }}</p>
                                <div class="mt-4">
                                    <span class="text-orange-500 font-semibold">
                                        Rp {{ number_format($service->price, 0, ',', '.') }}
                                    </span>
                                </div>
                                <div class="mt-4">
                                    <a href="{{ route('services.show', $service) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-teal-50 bg-teal-600 hover:bg-teal-500 hover:text-white transition duration-150 ease-in-out">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white bg-opacity-80 rounded-xl shadow-lg p-6 mb-6 border-l-8 border-yellow-300">
        <h2 class="text-2xl font-bold text-teal-700 mb-2">Selamat Datang di Online Booking Liburan!</h2>
        <p class="text-gray-700">Nikmati kemudahan reservasi layanan liburan Anda di sini.</p>
    </div>
</x-app-layout>