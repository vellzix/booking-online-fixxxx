<x-app-layout>
    <div class="bg-white">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
            <div class="pb-5 border-b border-gray-200 sm:flex sm:items-center sm:justify-between">
                <h1 class="text-3xl font-bold leading-tight text-gray-900">
                    Daftar Layanan
                </h1>
                @auth
                    @if(auth()->user()->isAdmin())
                        <div class="mt-3 sm:mt-0 sm:ml-4">
                            <a href="{{ route('services.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-orange-50 bg-orange-500 hover:bg-orange-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition duration-150 ease-in-out">
                                Tambah Layanan
                            </a>
                        </div>
                    @endif
                @endauth
            </div>

            <!-- Filters -->
            <div class="pt-6 pb-10">
                <form action="{{ route('services.index') }}" method="GET" class="grid grid-cols-1 gap-y-4 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-3">
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select id="category" name="category" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-teal-500 focus:border-teal-500 sm:text-sm rounded-md">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700">Cari</label>
                        <div class="mt-1">
                            <input type="text" name="search" id="search" value="{{ request('search') }}" class="shadow-sm focus:ring-teal-500 focus:border-teal-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Cari layanan...">
                        </div>
                    </div>

                    <div class="sm:flex sm:items-end">
                        <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-teal-50 bg-teal-600 hover:bg-teal-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 sm:w-auto transition duration-150 ease-in-out">
                            Filter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Services Grid -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @forelse($services as $service)
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
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">
                                    {{ $service->category->name }}
                                </span>
                                <span class="ml-2 text-orange-500 font-semibold">
                                    Rp {{ number_format($service->price, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="mt-4 flex space-x-3">
                                <a href="{{ route('services.show', $service) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-teal-50 bg-teal-600 hover:bg-teal-500 hover:text-white transition duration-150 ease-in-out">
                                    Lihat Detail
                                </a>
                                @auth
                                    @if(auth()->user()->isAdmin())
                                        <a href="{{ route('services.edit', $service) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                            Edit
                                        </a>
                                        <form action="{{ route('services.destroy', $service) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700" onclick="return confirm('Apakah Anda yakin ingin menghapus layanan ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada layanan</h3>
                        <p class="mt-1 text-sm text-gray-500">Tidak ada layanan yang ditemukan dengan filter yang dipilih.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $services->links() }}
            </div>
        </div>
    </div>
</x-app-layout> 