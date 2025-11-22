<x-app-layout>
    <x-slot name="header">
        {{-- Judul akan dinamis berdasarkan nomor kamar --}}
        {{ __('Edit Kamar: ') . $kamar->nomor_kamar }}
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        
        <form method="POST" action="{{ route('admin.kamar.update', $kamar) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <x-input-label for="nomor_kamar" :value="__('Nomor Kamar')" />
                <x-text-input id="nomor_kamar" class="block mt-1 w-full" type="text" name="nomor_kamar" 
                              :value="old('nomor_kamar', $kamar->nomor_kamar)" required autofocus />
                <x-input-error :messages="$errors->get('nomor_kamar')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="tipe_kamar" :value="__('Tipe Kamar')" />
                <select name="tipe_kamar" id="tipe_kamar" class="block mt-1 w-full border-gray-300 focus:border-amber-500 focus:ring-amber-500 rounded-md shadow-sm">
                    <option value="AC + KM Dalam" {{ old('tipe_kamar', $kamar->tipe_kamar) == 'AC + KM Dalam' ? 'selected' : '' }}>AC + KM Dalam</option>
                    <option value="Non-AC + KM Dalam" {{ old('tipe_kamar', $kamar->tipe_kamar) == 'Non-AC + KM Dalam' ? 'selected' : '' }}>Non-AC + KM Dalam</option>
                    <option value="Non-AC Standard" {{ old('tipe_kamar', $kamar->tipe_kamar) == 'Non-AC Standard' ? 'selected' : '' }}>Non-AC Standard</option>
                    <option value="AC Standard" {{ old('tipe_kamar', $kamar->tipe_kamar) == 'AC Standard' ? 'selected' : '' }}>AC Standard</option>
                </select>
                <x-input-error :messages="$errors->get('tipe_kamar')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="harga_sewa" :value="__('Harga Sewa (Per Bulan)')" />
                <x-text-input id="harga_sewa" class="block mt-1 w-full" type="number" name="harga_sewa" 
                              :value="old('harga_sewa', $kamar->harga_sewa)" required />
                <x-input-error :messages="$errors->get('harga_sewa')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="status" :value="__('Status Kamar')" />
                <select name="status" id="status" class="block mt-1 w-full border-gray-300 focus:border-amber-500 focus:ring-amber-500 rounded-md shadow-sm">
                    <option value="Kosong" {{ old('status', $kamar->status) == 'Kosong' ? 'selected' : '' }}>Kosong</Soption>
                    <option value="Terisi" {{ old('status', $kamar->status) == 'Terisi' ? 'selected' : '' }}>Terisi</option>
                    <option value="Perbaikan" {{ old('status', $kamar->status) == 'Perbaikan' ? 'selected' : '' }}>Perbaikan</option>
                </select>
                <x-input-error :messages="$errors->get('status')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="deskripsi" :value="__('Deskripsi (Opsional)')" />
                <textarea id="deskripsi" name="deskripsi" rows="3" class="block mt-1 w-full border-gray-300 focus:border-amber-500 focus:ring-amber-500 rounded-md shadow-sm" placeholder="Detail fasilitas atau kondisi kamar...">{{ old('deskripsi', $kamar->deskripsi) }}</textarea>
                <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-6">
                <a href="{{ route('admin.kamar.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">
                    Batal
                </a>
                <x-primary-button>
                    {{ __('Simpan Perubahan') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
