<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipe Kamar - Azka Living</title>
    <link rel="icon" type="image/png" href="{{ asset('foto/LogoKost.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    {{-- Load CSS & JS Pendukung --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Alpine.js diperlukan untuk interaktifitas tombol gedung --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        body { font-family: 'Playfair Display', serif; }
        .btn-gold { background-color: #c4a24c; padding: 10px 20px; border-radius: 20px; color: white; transition: background 0.3s; }
        .btn-gold:hover { background-color: #b39240; }
        .text-gold { color: #c4a24c; }
        .slider-btn { background-color: rgba(255, 255, 255, 0.7); color: #333; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.3s; }
        .slider-btn:hover { background-color: white; color: #c4a24c; }
        /* Style tombol gedung saat dipilih */
        .gedung-btn.active { background-color: #c4a24c; color: white; border-color: #c4a24c; }
    </style>
</head>

<body class="bg-gray-50 text-gray-900">

    {{-- NAVBAR --}}
    <nav class="flex justify-between items-center px-4 md:px-10 py-4 md:py-6 shadow bg-white fixed w-full top-0 z-50">
         <div><a href="{{ url('/') }}"><img src="{{ asset('foto/logo.jpg') }}" alt="Logo" class="w-10 md:w-14"></a></div>
        <ul class="hidden md:flex gap-8">
            <li><a href="{{ url('/') }}#tentang" class="hover:text-gray-600">Tentang</a></li>
            <li><a href="{{ url('/') }}#fasilitas" class="hover:text-gray-600">Fasilitas</a></li>
            <li><a href="{{ url('/') }}#hubungi-kami" class="hover:text-gray-600">Hubungi Kami</a></li>
            <li><a href="{{ route('landing_page.tipekamar') }}" class="text-[#c4a24c] font-bold">Tipe Kamar</a></li>
        </ul>
        <div class="flex items-center gap-3"><a class="btn-gold text-sm md:text-base" href="{{ url('/') }}#hubungi-kami">Jadwalkan Survei</a></div>
    </nav>

    <section class="pt-32 pb-20 px-4 md:px-10">
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h1 class="text-4xl md:text-6xl font-semibold mb-6 text-gray-900">Pilihan Tipe Kamar</h1>
            <p class="text-gray-600 text-lg leading-relaxed">
                Cek ketersediaan kamar riil berdasarkan gedung pilihan Anda.
            </p>
        </div>

        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-10 md:gap-16 items-start">

            {{-- ================= TIPE PREMIUM (KM DALAM) ================= --}}
            {{-- Cek apakah ada data harga dan ketersediaan riil dari DB --}}
            @if($hargaDalamTerendah && count($ketersediaanDalam) > 0)
            
            {{-- 
                Inisialisasi Alpine JS.
                'dataKetersediaan' diisi dengan data riil dari Controller ($ketersediaanDalam) yang diubah ke format JSON.
                Ini membuktikan kita menggunakan data yang sudah ada.
            --}}
            <div x-data="{ 
                    selectedGedung: '{{ array_key_first($ketersediaanDalam) }}', 
                    dataKetersediaan: {{ json_encode($ketersediaanDalam) }} 
                 }" 
                 class="bg-white rounded-[2.5rem] overflow-hidden shadow-2xl border border-gray-100 transform hover:-translate-y-2 transition-all duration-300">
                
                {{-- SLIDER GAMBAR (Menggunakan foto riil dari Galeri Admin) --}}
                <div class="relative h-72 md:h-[400px] group">
                    <img id="img-premium" src="{{ asset('storage/' . ($fotoDalam[0] ?? 'placeholder.jpg')) }}" alt="Kamar Mandi Dalam" class="w-full h-full object-cover transition-opacity duration-300">
                    <div class="absolute top-4 right-4 bg-[#c4a24c] text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg z-10">RECOMMENDED</div>
                    @if(count($fotoDalam) > 1)
                        <button onclick="changeSlide('premium', -1)" class="slider-btn absolute left-4 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 z-20">❮</button>
                        <button onclick="changeSlide('premium', 1)" class="slider-btn absolute right-4 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 z-20">❯</button>
                    @endif
                </div>
                
                <div class="p-8 md:p-10">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h2 class="text-3xl font-bold mb-1">Tipe Premium</h2>
                            <p class="text-[#c4a24c] font-semibold tracking-wider text-sm">KAMAR MANDI DALAM</p>
                        </div>
                    </div>

                    {{-- PILIHAN GEDUNG INTERAKTIF --}}
                    <div class="mb-6">
                        <h3 class="font-bold text-gray-700 mb-3">Pilih Lokasi Gedung:</h3>
                        <div class="flex flex-wrap gap-2">
                            {{-- Loop ini membuat tombol berdasarkan nama gedung riil yang ada di DB --}}
                            @foreach($ketersediaanDalam as $gedung => $jumlah)
                                <button @click="selectedGedung = '{{ $gedung }}'"
                                        :class="{ 'active': selectedGedung === '{{ $gedung }}' }"
                                        class="gedung-btn px-4 py-2 rounded-full border-2 border-gray-300 text-gray-600 font-medium transition-all hover:border-[#c4a24c] hover:text-[#c4a24c]">
                                    {{ $gedung }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    {{-- STATUS KETERSEDIAAN DINAMIS (Menggunakan data riil) --}}
                    <div class="mb-8 p-4 bg-gray-50 rounded-xl border border-gray-100">
                        {{-- Judul berubah sesuai tombol gedung yang diklik --}}
                        <h3 class="font-bold text-gray-700 mb-2" x-text="'Status di ' + selectedGedung + ':'"></h3>
                        
                        {{-- Tampilkan ini jika jumlah kamar kosong riil > 0 --}}
                        <div x-show="dataKetersediaan[selectedGedung] > 0" class="flex items-center text-green-600 font-semibold text-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            {{-- Angka yang muncul di sini adalah data riil dari DB --}}
                            <span x-text="dataKetersediaan[selectedGedung] + ' Kamar Tersedia'"></span>
                        </div>
                        
                        {{-- Tampilkan ini jika jumlah kamar kosong riil == 0 --}}
                        <div x-show="dataKetersediaan[selectedGedung] == 0" class="flex items-center text-red-500 font-semibold text-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span>Yah, Kamar Full</span>
                        </div>
                    </div>
                    
                    <h3 class="font-bold text-lg mb-4 border-b pb-2">Fasilitas Unggulan:</h3>
                    <ul class="grid grid-cols-1 gap-y-3 gap-x-4 mb-8 text-gray-700">
                        <li class="flex items-center gap-2"><span class="text-[#c4a24c]">✔</span> Kamar Mandi Pribadi</li>
                        <li class="flex items-center gap-2"><span class="text-[#c4a24c]">✔</span> Full AC Dingin</li>
                        <li class="flex items-center gap-2"><span class="text-[#c4a24c]">✔</span> WiFi High Speed</li>
                    </ul>

                    <div class="bg-gray-50 p-6 rounded-2xl flex flex-col md:flex-row justify-between items-center gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Harga mulai dari</p>
                            {{-- Harga riil dari DB --}}
                            <p class="text-3xl font-bold text-gray-900">Rp {{ number_format($hargaDalamTerendah, 0, ',', '.') }}<span class="text-sm font-normal text-gray-500">/bln</span></p>
                        </div>
                        {{-- Link WA & Teks Tombol berubah dinamis berdasarkan ketersediaan riil --}}
                        <a :href="'https://wa.me/628XXXXXXXX?text=Halo, saya tertarik dengan Tipe Premium (KM Dalam) di ' + selectedGedung + '. Apakah masih tersedia?'" target="_blank" class="btn-gold text-center w-full md:w-auto px-8 shadow-lg">
                            <span x-text="dataKetersediaan[selectedGedung] > 0 ? 'Booking Sekarang' : 'Tanya Waiting List'"></span>
                        </a>
                    </div>
                </div>
            </div>
            @endif

            {{-- ================= TIPE STANDARD (KM LUAR) ================= --}}
            {{-- Logika yang sama persis diterapkan untuk tipe KM Luar --}}
            @if($hargaLuarTerendah && count($ketersediaanLuar) > 0)
            <div x-data="{ 
                    selectedGedungLuar: '{{ array_key_first($ketersediaanLuar) }}', 
                    dataKetersediaanLuar: {{ json_encode($ketersediaanLuar) }} 
                 }"
                 class="bg-white rounded-[2.5rem] overflow-hidden shadow-xl border border-gray-100 transform hover:-translate-y-2 transition-all duration-300">
                
                <div class="relative h-72 md:h-[400px] group">
                    <img id="img-standard" src="{{ asset('storage/' . ($fotoLuar[0] ?? 'placeholder.jpg')) }}" alt="Kamar Mandi Luar" class="w-full h-full object-cover transition-opacity duration-300">
                    @if(count($fotoLuar) > 1)
                        <button onclick="changeSlide('standard', -1)" class="slider-btn absolute left-4 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 z-20">❮</button>
                        <button onclick="changeSlide('standard', 1)" class="slider-btn absolute right-4 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 z-20">❯</button>
                    @endif
                </div>
                
                <div class="p-8 md:p-10">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h2 class="text-3xl font-bold mb-1">Tipe Standard</h2>
                            <p class="text-gray-500 font-semibold tracking-wider text-sm">KAMAR MANDI LUAR</p>
                        </div>
                    </div>

                     {{-- PILIHAN GEDUNG --}}
                    <div class="mb-6">
                        <h3 class="font-bold text-gray-700 mb-3">Pilih Lokasi Gedung:</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($ketersediaanLuar as $gedung => $jumlah)
                                <button @click="selectedGedungLuar = '{{ $gedung }}'"
                                        :class="{ 'active': selectedGedungLuar === '{{ $gedung }}' }"
                                        class="gedung-btn px-4 py-2 rounded-full border-2 border-gray-300 text-gray-600 font-medium transition-all hover:border-[#c4a24c] hover:text-[#c4a24c]">
                                    {{ $gedung }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    {{-- STATUS KETERSEDIAAN DINAMIS --}}
                    <div class="mb-8 p-4 bg-gray-50 rounded-xl border border-gray-100">
                        <h3 class="font-bold text-gray-700 mb-2" x-text="'Status di ' + selectedGedungLuar + ':'"></h3>
                        <div x-show="dataKetersediaanLuar[selectedGedungLuar] > 0" class="flex items-center text-green-600 font-semibold text-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span x-text="dataKetersediaanLuar[selectedGedungLuar] + ' Kamar Tersedia'"></span>
                        </div>
                        <div x-show="dataKetersediaanLuar[selectedGedungLuar] == 0" class="flex items-center text-red-500 font-semibold text-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span>Yah, Kamar Full</span>
                        </div>
                    </div>
                    
                     <h3 class="font-bold text-lg mb-4 border-b pb-2">Fasilitas Unggulan:</h3>
                    <ul class="grid grid-cols-1 gap-y-3 gap-x-4 mb-8 text-gray-700">
                        <li class="flex items-center gap-2"><span class="text-gray-400">✔</span> Kamar Mandi Luar Bersih</li>
                        <li class="flex items-center gap-2"><span class="text-gray-400">✔</span> Kipas Angin / AC (Opsional)</li>
                        <li class="flex items-center gap-2"><span class="text-gray-400">✔</span> WiFi High Speed</li>
                    </ul>

                    <div class="bg-gray-50 p-6 rounded-2xl flex flex-col md:flex-row justify-between items-center gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Harga mulai dari</p>
                            <p class="text-3xl font-bold text-gray-900">Rp {{ number_format($hargaLuarTerendah, 0, ',', '.') }}<span class="text-sm font-normal text-gray-500">/bln</span></p>
                        </div>
                        <a :href="'https://wa.me/628XXXXXXXX?text=Halo, saya tertarik dengan Tipe Standard (KM Luar) di ' + selectedGedungLuar + '. Apakah masih tersedia?'" target="_blank" class="bg-gray-800 hover:bg-gray-900 text-white px-8 py-3 rounded-2xl transition-all shadow-lg text-center w-full md:w-auto">
                             <span x-text="dataKetersediaanLuar[selectedGedungLuar] > 0 ? 'Booking Sekarang' : 'Tanya Waiting List'"></span>
                        </a>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </section>

    {{-- FOOTER & SCRIPT SLIDER (Sama seperti sebelumnya, menggunakan data riil dari controller) --}}
    <footer class="mt-10 px-4 md:px-10 py-10 border-t bg-white">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center">
             <div class="flex items-center gap-4 mb-4 md:mb-0"><img src="{{ asset('foto/logo.jpg') }}" alt="Logo" class="w-10 md:w-14"> <p class="text-sm text-gray-600">© Kost Azka, <span id="year"></span></p></div>
            <div class="text-sm text-gray-600"><a href="{{ url('/') }}" class="hover:text-[#c4a24c] transition-colors">Kembali ke Beranda</a></div>
        </div>
    </footer>

    <script>
        document.getElementById("year").textContent = new Date().getFullYear();
        // Data gambar riil dari Controller
        const images = {
            premium: @json(array_map(function($path) { return asset('storage/' . $path); }, $fotoDalam)),
            standard: @json(array_map(function($path) { return asset('storage/' . $path); }, $fotoLuar))
        };
        let currentIndex = { premium: 0, standard: 0 };
        function changeSlide(type, direction) {
            let newIndex = currentIndex[type] + direction;
            if (newIndex >= images[type].length) newIndex = 0;
            else if (newIndex < 0) newIndex = images[type].length - 1;
            currentIndex[type] = newIndex;
            const imgElement = document.getElementById(`img-${type}`);
            imgElement.style.opacity = 0;
            setTimeout(() => {
                imgElement.src = images[type][newIndex];
                imgElement.style.opacity = 1;
            }, 150);
        }
    </script>
</body>
</html>