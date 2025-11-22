<x-app-layout>
    <x-slot name="header">
        {{ __('Upload Foto Baru') }}
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 max-w-2xl mx-auto">
        
        <form method="POST" action="{{ route('admin.galeri.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <x-input-label for="foto" :value="__('Pilih Foto (Max: 2MB)')" class="mb-2"/>
                <input id="foto" class="block mt-1 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" type="file" name="foto" required onchange="previewImage(event)">
                <p class="mt-1 text-sm text-gray-500" id="file_input_help">PNG, JPG, JPEG, atau WEBP.</p>
                <x-input-error :messages="$errors->get('foto')" class="mt-2" />
            </div>

            <div class="mb-4">
                <img id="image_preview" src="" alt="Image Preview" class="w-full h-auto rounded-lg hidden border border-gray-200"/>
            </div>

            <div class="mb-4">
                <x-input-label for="kategori" :value="__('Kategori (Opsional)')" />
                <x-text-input id="kategori" class="block mt-1 w-full bg-[#D4BE7F] !bg-[#D4BE7F] focus:ring-amber-500 focus:border-amber-500 !ring-amber-500" type="text" name="kategori" :value="old('kategori')" placeholder="Misal: Fasilitas Umum, Kamar Tipe A" />
                <x-input-error :messages="$errors->get('kategori')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-6">
                <a href="{{ route('admin.galeri.index') }}" class="text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                <x-primary-button>
                    {{ __('Upload') }}
                </x-primary-button>
            </div>
        </form>

        <script>
            function previewImage(event) {
                var reader = new FileReader();
                var imagePreview = document.getElementById('image_preview');
                reader.onload = function(){
                    if(reader.readyState == 2){
                        imagePreview.src = reader.result;
                        imagePreview.classList.remove('hidden');
                    }
                }
                reader.readAsDataURL(event.target.files[0]);
            }
        </script>

    </div>
</x-app-layout>