<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah Kamar Baru') }}
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <form method="POST" action="{{ route('admin.kamar.store') }}">
            @csrf

            <div class="mb-4">
                <x-input-label for="nomor_kamar" :value="__('Nomor Kamar')" />
                <x-text-input id="nomor_kamar" class="block mt-1 w-full bg-[#D4BE7F] !bg-[#D4BE7F] focus:ring-amber-500 focus:border-amber-500 !ring-amber-500" type="text" name="nomor_kamar" :value="old('nomor_kamar')" required autofocus placeholder="Contoh: 01" />
                <x-input-error :messages="$errors->get('nomor_kamar')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="gedung" :value="__('Lokasi Gedung')" />
                <select name="gedung" id="gedung" class="block mt-1 w-full border-gray-300 focus:border-amber-500 focus:ring-amber-500 rounded-md shadow-sm">
                    <option value="" disabled {{ old('gedung') ? '' : 'selected' }}>Pilih Gedung</option>
                    <option value="Gedung 1" {{ old('gedung') == 'Gedung 1' ? 'selected' : '' }}>Gedung 1</option>
                    <option value="Gedung 2" {{ old('gedung') == 'Gedung 2' ? 'selected' : '' }}>Gedung 2</option>
                    <option value="Gedung 3" {{ old('gedung') == 'Gedung 3' ? 'selected' : '' }}>Gedung 3</option>
                </select>
                <x-input-error :messages="$errors->get('gedung')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="jenis_kamar_mandi" :value="__('Jenis Kamar Mandi')" />
                <select name="jenis_kamar_mandi" id="jenis_kamar_mandi" class="block mt-1 w-full border-gray-300 focus:border-amber-500 focus:ring-amber-500 rounded-md shadow-sm">
                    <option value="" disabled {{ old('jenis_kamar_mandi') ? '' : 'selected' }}>Pilih Jenis</option>
                    <option value="Dalam" {{ old('jenis_kamar_mandi') == 'Dalam' ? 'selected' : '' }}>Kamar Mandi Dalam</option>
                    <option value="Luar" {{ old('jenis_kamar_mandi') == 'Luar' ? 'selected' : '' }}>Kamar Mandi Luar</option>
                </select>
                <x-input-error :messages="$errors->get('jenis_kamar_mandi')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="harga_sewa" :value="__('Harga Sewa (Per Bulan)')" />
                <x-text-input id="harga_sewa" class="block mt-1 w-full bg-[#D4BE7F] !bg-[#D4BE7F] focus:ring-amber-500 focus:border-amber-500 !ring-amber-500" type="number" name="harga_sewa" :value="old('harga_sewa')" required placeholder="Contoh: 1500000" />
                <x-input-error :messages="$errors->get('harga_sewa')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="status" :value="__('Status Kamar')" />
                <select name="status" id="status" class="block mt-1 w-full border-gray-300 focus:border-amber-500 focus:ring-amber-500 rounded-md shadow-sm">
                    <option value="Kosong" {{ old('status') == 'Kosong' ? 'selected' : '' }}>Kosong</option>
                    <option value="Terisi" {{ old('status') == 'Terisi' ? 'selected' : '' }}>Terisi</option>
                    <option value="Perbaikan" {{ old('status') == 'Perbaikan' ? 'selected' : '' }}>Perbaikan</option>
                </select>
                <x-input-error :messages="$errors->get('status')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="deskripsi" :value="__('Deskripsi (Opsional)')" />
                <textarea id="deskripsi" name="deskripsi" rows="3" class="block mt-1 w-full border-gray-300 focus:border-amber-500 focus:ring-amber-500 rounded-md shadow-sm" placeholder="Detail fasilitas atau kondisi kamar...">{{ old('deskripsi') }}</textarea>
                <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-6">
                <a href="{{ route('admin.kamar.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                <x-primary-button>
                    {{ __('Tambah') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>