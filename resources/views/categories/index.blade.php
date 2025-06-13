<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="pb-5 border-b border-gray-200 sm:flex sm:items-center sm:justify-between">
            <h1 class="text-3xl font-bold leading-tight text-gray-900">
                Kategori Layanan
            </h1>
            @auth
                @if(auth()->user()->isAdmin())
                    <div class="mt-3 sm:mt-0 sm:ml-4">
                        <a href="{{ route('categories.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Tambah Kategori
                        </a>
                    </div>
                @endif
            @endauth
        </div>

        <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($categories as $category)
                <div class="bg-white overflow-hidden shadow rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-12 w-12 bg-indigo-100 rounded-full flex items-center justify-center">
                                <i class="fas {{ $category->icon }} text-2xl text-indigo-600"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">
                                    <a href="{{ route('categories.show', $category) }}" class="hover:text-indigo-600">
                                        {{ $category->name }}
                                    </a>
                                </h3>
                                <p class="text-sm text-gray-500">{{ $category->services_count }} layanan</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <p class="text-sm text-gray-500">{{ $category->description }}</p>
                        </div>
                        @auth
                            @if(auth()->user()->isAdmin())
                                <div class="mt-6 flex space-x-3">
                                    <a href="{{ route('categories.edit', $category) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                        Edit
                                    </a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700" onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada kategori</h3>
                    <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan kategori baru.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout> 