<x-app-layout>
    <x-slot name="header">
        {{ __('Informasi Kamar') }}
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- BAGIAN ATAS: Tombol Tambah & Form Pencarian --}}
                    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                        <a href="{{ route('admin.kamar.create') }}" class="inline-flex items-center px-4 py-2 bg-[#D4BE7F] hover:bg-[#c2aa6b] border border-transparent rounded-md font-bold text-xs text-white uppercase tracking-widest focus:outline-none transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                            Tambah Kamar Baru
                        </a>

                        <form action="{{ route('admin.kamar.index') }}" method="GET" class="flex w-full md:w-auto items-center gap-2">
                            <div class="relative flex-grow">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                                </div>
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nomor kamar, gedung..." class="block w-full pl-10 pr-3 py-2 border-gray-300 focus:border-amber-500 focus:ring-amber-500 rounded-md shadow-sm text-sm">
                            </div>
                            <select name="status" onchange="this.form.submit()" class="block py-2 pl-3 pr-10 border-gray-300 focus:border-amber-500 focus:ring-amber-500 rounded-md shadow-sm text-sm">
                                <option value="">Semua Status</option>
                                <option value="Kosong" {{ request('status') == 'Kosong' ? 'selected' : '' }}>Kosong</option>
                                <option value="Terisi" {{ request('status') == 'Terisi' ? 'selected' : '' }}>Terisi</option>
                                <option value="Perbaikan" {{ request('status') == 'Perbaikan' ? 'selected' : '' }}>Perbaikan</option>
                            </select>
                        </form>
                    </div>

                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-800 font-medium rounded-lg flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- TABEL DATA --}}
                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">No. Kamar</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Gedung</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Kamar Mandi</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Harga Sewa</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider w-1/6">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($kamars as $kamar)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $kamar->nomor_kamar }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $kamar->gedung }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $kamar->jenis_kamar_mandi }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                $statusClass = match($kamar->status) {
                                                    'Kosong' => 'bg-green-100 text-green-800',
                                                    'Terisi' => 'bg-gray-100 text-gray-800',
                                                    'Perbaikan' => 'bg-red-100 text-red-800',
                                                    default => 'bg-gray-100 text-gray-800'
                                                };
                                            @endphp
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                                {{ $kamar->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">Rp {{ number_format($kamar->harga_sewa, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('admin.kamar.edit', $kamar->id) }}" class="text-amber-600 hover:text-amber-900 mr-3 font-semibold">Edit</a>
                                            
                                            <button type="button" 
                                                    class="text-red-600 hover:text-red-900 font-semibold" 
                                                    x-data=""
                                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-kamar-deletion-{{ $kamar->id }}')">
                                                Hapus
                                            </button>

                                            {{-- MODAL KONFIRMASI HAPUS --}}
                                            <x-confirm-modal name="confirm-kamar-deletion-{{ $kamar->id }}">
                                                <form method="post" action="{{ route('admin.kamar.destroy', $kamar->id) }}" class="p-6">
                                                    @csrf
                                                    @method('delete')

                                                    <h2 class="text-lg font-medium text-gray-900 flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                                                        Hapus Kamar {{ $kamar->nomor_kamar }}?
                                                    </h2>

                                                    <p class="mt-3 text-sm text-gray-600">
                                                        Apakah Anda yakin ingin menghapus data kamar ini? Tindakan ini tidak dapat dibatalkan dan semua data terkait akan hilang permanen.
                                                    </p>

                                                    <div class="mt-6 flex justify-end gap-3">
                                                        <x-secondary-button x-on:click="$dispatch('close-modal', 'confirm-kamar-deletion-{{ $kamar->id }}')">
                                                            Batal
                                                        </x-secondary-button>

                                                        <x-danger-button class="ms-3">
                                                            Ya, Hapus Kamar
                                                        </x-danger-button>
                                                    </div>
                                                </form>
                                            </x-confirm-modal>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-8 whitespace-nowrap text-center text-gray-500">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                                                <p class="text-lg font-medium text-gray-900">Belum ada data kamar</p>
                                                <p class="text-sm text-gray-500">Silakan tambahkan kamar baru atau ubah filter pencarian Anda.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- PAGINATION --}}
                    <div class="mt-6">
                        {{ $kamars->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>