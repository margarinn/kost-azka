<x-app-layout>
    <x-slot name="header">
        {{ __('Galeri Kost') }}
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
            <div class="flex items-center space-x-2 flex-wrap gap-2">
                <a href="{{ route('admin.galeri.index') }}"
                class="px-4 py-2 text-sm font-medium rounded-md
                        {{-- Jika tidak ada filter 'kategori' di URL, buat tombol ini aktif --}}
                        {{ !request('kategori') ? 'text-amber-600 bg-amber-50 border border-amber-600' : 'text-gray-700 bg-white border border-gray-300 hover:bg-gray-100' }}">
                    Semua
                </a>

                @foreach ($kategoris as $kategori)
                    <a href="{{ route('admin.galeri.index', ['kategori' => $kategori]) }}"
                    class="px-4 py-2 text-sm font-medium rounded-md
                            {{-- Jika filter 'kategori' di URL = $kategori ini, buat tombol aktif --}}
                            {{ request('kategori') == $kategori ? 'text-amber-600 bg-amber-50 border border-amber-600' : 'text-gray-700 bg-white border border-gray-300 hover:bg-gray-100' }}">
                        {{ $kategori }}
                    </a>
                @endforeach

            </div>

            <a href="{{ route('admin.galeri.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Upload Foto Baru
            </a>
        </div>

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
            @forelse ($fotos as $foto)
                <div class="relative group border border-gray-200 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-200">
                    <img src="{{ asset('storage/' . $foto->foto_path) }}" alt="Foto Kost - {{ $foto->kategori }}" class="w-full h-32 sm:h-40 object-cover">

                    @if($foto->kategori)
                        <span class="absolute top-2 left-2 bg-black bg-opacity-50 text-white text-xs px-2 py-1 rounded">
                            {{ $foto->kategori }}
                        </span>
                    @endif

                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        <button type="button"
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-xs"
                                x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-foto-deletion-{{ $foto->id }}')">
                            Hapus
                        </button>
                    </div>
                    <x-confirm-modal name="confirm-foto-deletion-{{ $foto->id }}" maxWidth="sm">
                        <form method="post" action="{{ route('admin.galeri.destroy', $foto->id) }}" class="p-6">
                            @csrf
                            @method('delete')
                            <h2 class="text-lg font-medium text-gray-900">
                                Hapus Foto Ini?
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                Foto ini akan dihapus secara permanen dari galeri.
                            </p>

                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close-modal', 'confirm-foto-deletion-{{ $foto->id }}')">
                                    Batal
                                </x-secondary-button>

                                <x-danger-button class="ms-3">
                                    Hapus Foto
                                </x-danger-button>
                            </div>
                        </form>
                    </x-confirm-modal>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-500 py-10">
                    Belum ada foto di galeri. Klik "Upload Foto Baru" untuk memulai.
                </p>
            @endforelse
        </div>

        {{-- <div class="mt-6">
            {{ $fotos->links() }}
        </div> --}}
    </div>
</x-app-layout>