<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Informasi Kamar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <a href="{{ route('admin.kamar.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 transition mb-4">
                        + Tambah Kamar Baru
                    </a>

                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Kamar</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe Kamar</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga Sewa</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($kamars as $kamar)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $kamar->nomor_kamar }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $kamar->tipe_kamar }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($kamar->status == 'Terisi')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Terisi
                                                </span>
                                            @elseif ($kamar->status == 'Kosong')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                    Kosong
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    Perbaikan
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($kamar->harga_sewa, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('admin.kamar.edit', $kamar->id) }}" class="text-amber-600 hover:text-amber-900 mr-2">Edit</a>
                                            <button type="button" 
                                                    class="text-red-600 hover:text-red-900 ml-2" 
                                                    x-data=""
                                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-kamar-deletion-{{ $kamar->id }}')">
                                                Hapus
                                            </button>
                                            <x-confirm-modal name="confirm-kamar-deletion-{{ $kamar->id }}">
                                                <form method="post" action="{{ route('admin.kamar.destroy', $kamar->id) }}" class="p-6">
                                                    @csrf
                                                    @method('delete')

                                                    <h2 class="text-lg font-medium text-gray-900">
                                                        Apakah Anda yakin ingin menghapus kamar nomor {{ $kamar->nomor_kamar }}?
                                                    </h2>

                                                    <p class="mt-1 text-sm text-gray-600">
                                                        Semua data terkait kamar ini akan dihapus secara permanen.
                                                    </p>

                                                    <div class="mt-6 flex justify-end">
                                                        <x-secondary-button x-on:click="$dispatch('close-modal', 'confirm-kamar-deletion-{{ $kamar->id }}')">
                                                            Batal
                                                        </x-secondary-button>

                                                        <x-danger-button class="ms-3">
                                                            Hapus Kamar
                                                        </x-danger-button>
                                                    </div>
                                                </form>
                                            </x-confirm-modal>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                            Belum ada data kamar.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>