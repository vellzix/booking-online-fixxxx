<x-app-layout>
    <div class="max-w-4xl mx-auto py-12">
        <h1 class="text-3xl font-bold mb-4">{{ $category->name }}</h1>
        <p class="mb-8 text-gray-600">{{ $category->description }}</p>

        <h2 class="text-xl font-semibold mb-2">Layanan dalam kategori ini:</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @forelse($services as $service)
                <div class="bg-white rounded-lg shadow p-4">
                    <h3 class="text-lg font-bold">{{ $service->name }}</h3>
                    <p class="text-gray-500">{{ $service->description }}</p>
                    <a href="{{ route('services.show', $service) }}" class="text-teal-600 hover:underline mt-2 inline-block">Lihat Detail</a>
                </div>
            @empty
                <p class="text-gray-500">Belum ada layanan di kategori ini.</p>
            @endforelse
        </div>
    </div>
</x-app-layout> 