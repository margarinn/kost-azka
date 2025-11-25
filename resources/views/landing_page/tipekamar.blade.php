<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipe Kamar - Azka Living</title>
    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('foto/LogoKost.png') }}">
    <link rel="shortcut icon" href="{{ asset('foto/LogoKost.png') }}">

    {{-- Fonts & Tailwind/Alpine --}}
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        /* Base Styles */
        body { font-family: 'Playfair Display', serif; }
        
        /* Style Tombol Gold (Ukuran disesuaikan untuk mobile dan desktop) */
        .btn-gold { 
            background-color: #c4a24c; 
            padding: 8px 16px; /* Padding default (mobile) */
            border-radius: 20px; 
            color: white; 
            transition: background 0.3s; 
            font-size: 0.85rem; /* Font size default (mobile) */
        }
        @media (min-width: 768px) { /* Tablet & Desktop */
            .btn-gold {
                padding: 10px 20px;
                font-size: 0.9rem;
            }
        }
        .btn-gold:hover { background-color: #b39240; }
        .text-gold { color: #c4a24c; }

        /* Style Slider Button */
        .slider-btn { 
            background-color: rgba(255, 255, 255, 0.7); 
            color: #333; 
            width: 32px; height: 32px; 
            border-radius: 50%; 
            display: flex; align-items: center; justify-content: center; 
            cursor: pointer; transition: all 0.3s; 
        }
        @media (min-width: 768px) {
            .slider-btn { width: 36px; height: 36px; }
        }
        .slider-btn:hover { background-color: white; color: #c4a24c; }

        /* Style Tombol Gedung */
        .gedung-btn.active { background-color: #c4a24c; color: white; border-color: #c4a24c; }
        .gedung-btn { 
            padding: 6px 12px; 
            font-size: 0.8rem; 
        }
        @media (min-width: 768px) {
            .gedung-btn { font-size: 0.85rem; }
        }

        /* Navbar Mobile Transition */
        #mobile-menu { transition: all 0.3s ease-in-out; }
    </style>
</head>

<body class="bg-gray-50 text-gray-900 overflow-x-hidden">

    {{-- NAVBAR (Responsif dengan Mobile Menu Toggle) --}}
    <nav class="flex justify-between items-center px-4 md:px-8 py-3 md:py-4 shadow bg-white fixed w-full top-0 z-50 transition-all duration-300" x-data="{ open: false }">
         <div>
            <a href="{{ url('/') }}">
                <img src="{{ asset('foto/logo.jpg') }}" alt="Logo" class="w-8 md:w-10">
            </a>
         </div>
        
        {{-- Menu Desktop (Hidden di Mobile) --}}
        <ul class="hidden md:flex gap-6 text-sm">
            <li><a href="{{ url('/') }}#tentang" class="hover:text-gray-600">Tentang</a></li>
            <li><a href="{{ url('/') }}#fasilitas" class="hover:text-gray-600">Fasilitas</a></li>
            <li><a href="{{ url('/') }}#hubungi-kami" class="hover:text-gray-600">Hubungi Kami</a></li>
            {{-- Link Aktif --}}
            <li><a href="{{ route('landing_page.tipekamar') }}" class="text-[#c4a24c] font-bold border-b-2 border-[#c4a24c] pb-1">Tipe Kamar</a></li>
        </ul>

        <div class="flex items-center gap-3">
            <a class="btn-gold hidden md:inline-block" href="{{ url('/') }}#hubungi-kami">Jadwalkan Survei</a>
            
            {{-- Mobile Menu Button (Hamburger) --}}
            <button @click="open = !open" class="md:hidden p-2 text-gray-800 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    <path x-show="open" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Mobile Menu Dropdown --}}
        <div x-show="open" x-cloak 
             @click.away="open = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 transform -translate-y-2"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-2"
             class="absolute top-full left-0 w-full bg-white shadow-lg md:hidden border-t border-gray-100 z-40 text-sm">
            <ul class="flex flex-col text-center py-4 space-y-2 font-medium">
                <li><a href="{{ url('/') }}#tentang" class="block py-2 hover:bg-gray-50 hover:text-[#c4a24c]">Tentang</a></li>
                <li><a href="{{ url('/') }}#fasilitas" class="block py-2 hover:bg-gray-50 hover:text-[#c4a24c]">Fasilitas</a></li>
                {{-- Link Aktif di Mobile --}}
                <li><a href="{{ route('landing_page.tipekamar') }}" class="block py-2 bg-gray-50 text-[#c4a24c] font-bold">Tipe Kamar</a></li>
                <li><a href="{{ url('/') }}#hubungi-kami" class="block py-2 hover:bg-gray-50 hover:text-[#c4a24c]">Hubungi Kami</a></li>
                <li class="pt-2"><a class="btn-gold inline-block" href="{{ url('/') }}#hubungi-kami">Jadwalkan Survei</a></li>
            </ul>
        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <section class="pt-24 pb-16 px-4 md:px-8">
        
        {{-- Header Section --}}
        <div class="text-center max-w-2xl mx-auto mb-10 md:mb-12">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-semibold mb-3 md:mb-4 text-gray-900 leading-tight">Pilihan Tipe Kamar</h1>
            <p class="text-gray-600 text-sm md:text-base leading-relaxed px-2">
                Cek ketersediaan kamar dan harga riil berdasarkan gedung pilihan Anda.
            </p>
        </div>

        {{-- Grid Container: 1 Kolom di Mobile, 2 Kolom di Layar Besar (lg) --}}
        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8 md:gap-10 lg:gap-12 items-start">

            {{-- ================= TIPE PREMIUM (KM DALAM) ================= --}}
            @if(count($dataDalam) > 0)
            <div x-data="{ 
                    selectedGedung: '{{ array_key_first($dataDalam) }}', 
                    dataKetersediaan: {{ json_encode($dataDalam) }},
                    formatRupiah(angka) { return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka); }
                 }" 
                 class="bg-white rounded-[1.5rem] md:rounded-[2rem] overflow-hidden shadow-lg md:shadow-xl border border-gray-100 transform lg:hover:-translate-y-1 transition-all duration-300">
                
                {{-- Slider Gambar: Tinggi disesuaikan untuk mobile (h-56) dan desktop (md:h-72) --}}
                <div class="relative h-56 md:h-72 group">
                    <img id="img-premium" src="{{ asset('storage/' . ($fotoDalam[0] ?? 'placeholder.jpg')) }}" alt="Kamar Mandi Dalam" class="w-full h-full object-cover transition-opacity duration-300">
                    <div class="absolute top-3 right-3 bg-[#c4a24c] text-white px-2 py-1 md:px-3 rounded-full text-[0.65rem] md:text-xs font-bold shadow-sm z-10">RECOMMENDED</div>
                    @if(count($fotoDalam) > 1)
                        {{-- Tombol slider: Selalu muncul di mobile, hover-only di desktop --}}
                        <button onclick="changeSlide('premium', -1)" class="slider-btn absolute left-3 top-1/2 -translate-y-1/2 opacity-100 lg:opacity-0 group-hover:opacity-100 z-20">❮</button>
                        <button onclick="changeSlide('premium', 1)" class="slider-btn absolute right-3 top-1/2 -translate-y-1/2 opacity-100 lg:opacity-0 group-hover:opacity-100 z-20">❯</button>
                    @endif
                </div>
                
                {{-- Content Area: Padding disesuaikan --}}
                <div class="p-5 md:p-6 lg:p-8">
                    <div class="mb-4">
                        <h2 class="text-xl md:text-2xl font-bold mb-1">Tipe Premium</h2>
                        <p class="text-[#c4a24c] font-semibold tracking-wider text-[0.65rem] md:text-xs">KAMAR MANDI DALAM</p>
                    </div>

                    {{-- Pilihan Gedung --}}
                    <div class="mb-5">
                        <h3 class="font-bold text-gray-700 mb-2 text-sm">Pilih Lokasi Gedung:</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($dataDalam as $gedung => $info)
                                <button @click="selectedGedung = '{{ $gedung }}'"
                                        :class="{ 'active': selectedGedung === '{{ $gedung }}' }"
                                        class="gedung-btn rounded-full border-2 border-gray-300 text-gray-600 font-medium transition-all hover:border-[#c4a24c] hover:text-[#c4a24c]">
                                    {{ $gedung }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    {{-- Status Ketersediaan --}}
                    <div class="mb-6 p-3 bg-gray-50 rounded-lg border border-gray-100 flex justify-between items-center">
                        <h3 class="font-bold text-gray-700 text-sm" x-text="'Status di ' + selectedGedung + ':'"></h3>
                        
                        <div x-show="dataKetersediaan[selectedGedung].tersedia > 0" class="flex items-center text-green-600 font-semibold text-sm md:text-base">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span x-text="dataKetersediaan[selectedGedung].tersedia + ' Tersedia'"></span>
                        </div>
                        
                        <div x-show="dataKetersediaan[selectedGedung].tersedia == 0" class="flex items-center text-red-500 font-semibold text-sm md:text-base">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span>Full</span>
                        </div>
                    </div>
                    
                    <h3 class="font-bold text-sm md:text-base mb-3 border-b pb-1">Fasilitas Unggulan:</h3>
                    <ul class="grid grid-cols-1 gap-y-2 gap-x-4 mb-6 text-xs md:text-sm text-gray-700">
                        <li class="flex items-center gap-2"><span class="text-[#c4a24c]">✔</span> Kamar Mandi Pribadi</li>
                        <li class="flex items-center gap-2"><span class="text-[#c4a24c]">✔</span> Full AC Dingin</li>
                        <li class="flex items-center gap-2"><span class="text-[#c4a24c]">✔</span> WiFi High Speed</li>
                    </ul>

                    {{-- Price & CTA Section: Flex column di mobile, row di desktop --}}
                    <div class="bg-gray-50 p-4 rounded-xl flex flex-col md:flex-row justify-between items-center gap-3">
                        <div class="text-center md:text-left">
                            <p class="text-xs text-gray-500">Harga mulai dari</p>
                            <p class="text-xl md:text-2xl font-bold text-gray-900">
                                <span x-text="formatRupiah(dataKetersediaan[selectedGedung].harga_mulai)"></span>
                                <span class="text-[0.65rem] md:text-xs font-normal text-gray-500">/bln</span>
                            </p>
                        </div>
                        {{-- Tombol full width di mobile --}}
                        <a :href="'https://wa.me/628XXXXXXXX?text=Halo, saya tertarik dengan Tipe Premium (KM Dalam) di ' + selectedGedung + '. Apakah masih tersedia?'" target="_blank" class="btn-gold text-center w-full md:w-auto shadow-md">
                            <span x-text="dataKetersediaan[selectedGedung].tersedia > 0 ? 'Booking Sekarang' : 'Waiting List'"></span>
                        </a>
                    </div>
                </div>
            </div>
            @endif

            {{-- ================= TIPE STANDARD (KM LUAR) ================= --}}
            {{-- Menerapkan penyesuaian responsif yang sama persis --}}
            @if(count($dataLuar) > 0)
            <div x-data="{ 
                    selectedGedungLuar: '{{ array_key_first($dataLuar) }}', 
                    dataKetersediaanLuar: {{ json_encode($dataLuar) }},
                    formatRupiah(angka) { return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka); }
                 }"
                 class="bg-white rounded-[1.5rem] md:rounded-[2rem] overflow-hidden shadow-md border border-gray-100 transform lg:hover:-translate-y-1 transition-all duration-300">
                
                <div class="relative h-56 md:h-72 group">
                    <img id="img-standard" src="{{ asset('storage/' . ($fotoLuar[0] ?? 'placeholder.jpg')) }}" alt="Kamar Mandi Luar" class="w-full h-full object-cover transition-opacity duration-300">
                    @if(count($fotoLuar) > 1)
                        <button onclick="changeSlide('standard', -1)" class="slider-btn absolute left-3 top-1/2 -translate-y-1/2 opacity-100 lg:opacity-0 group-hover:opacity-100 z-20">❮</button>
                        <button onclick="changeSlide('standard', 1)" class="slider-btn absolute right-3 top-1/2 -translate-y-1/2 opacity-100 lg:opacity-0 group-hover:opacity-100 z-20">❯</button>
                    @endif
                </div>
                
                <div class="p-5 md:p-6 lg:p-8">
                    <div class="mb-4">
                        <h2 class="text-xl md:text-2xl font-bold mb-1">Tipe Standard</h2>
                        <p class="text-gray-500 font-semibold tracking-wider text-[0.65rem] md:text-xs">KAMAR MANDI LUAR</p>
                    </div>

                    <div class="mb-5">
                        <h3 class="font-bold text-gray-700 mb-2 text-sm">Pilih Lokasi Gedung:</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($dataLuar as $gedung => $info)
                                <button @click="selectedGedungLuar = '{{ $gedung }}'"
                                        :class="{ 'active': selectedGedungLuar === '{{ $gedung }}' }"
                                        class="gedung-btn rounded-full border-2 border-gray-300 text-gray-600 font-medium transition-all hover:border-[#c4a24c] hover:text-[#c4a24c]">
                                    {{ $gedung }}
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-6 p-3 bg-gray-50 rounded-lg border border-gray-100 flex justify-between items-center">
                        <h3 class="font-bold text-gray-700 text-sm" x-text="'Status di ' + selectedGedungLuar + ':'"></h3>
                        <div x-show="dataKetersediaanLuar[selectedGedungLuar].tersedia > 0" class="flex items-center text-green-600 font-semibold text-sm md:text-base">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span x-text="dataKetersediaanLuar[selectedGedungLuar].tersedia + ' Tersedia'"></span>
                        </div>
                        <div x-show="dataKetersediaanLuar[selectedGedungLuar].tersedia == 0" class="flex items-center text-red-500 font-semibold text-sm md:text-base">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span>Full</span>
                        </div>
                    </div>
                    
                     <h3 class="font-bold text-sm md:text-base mb-3 border-b pb-1">Fasilitas Unggulan:</h3>
                    <ul class="grid grid-cols-1 gap-y-2 gap-x-4 mb-6 text-xs md:text-sm text-gray-700">
                        <li class="flex items-center gap-2"><span class="text-gray-400">✔</span> Kamar Mandi Luar Bersih</li>
                        <li class="flex items-center gap-2"><span class="text-gray-400">✔</span> Kipas Angin / AC (Opsional)</li>
                        <li class="flex items-center gap-2"><span class="text-gray-400">✔</span> WiFi High Speed</li>
                    </ul>

                    <div class="bg-gray-50 p-4 rounded-xl flex flex-col md:flex-row justify-between items-center gap-3">
                        <div class="text-center md:text-left">
                            <p class="text-xs text-gray-500">Harga mulai dari</p>
                            <p class="text-xl md:text-2xl font-bold text-gray-900">
                                <span x-text="formatRupiah(dataKetersediaanLuar[selectedGedungLuar].harga_mulai)"></span>
                                <span class="text-[0.65rem] md:text-xs font-normal text-gray-500">/bln</span>
                            </p>
                        </div>
                        <a :href="'https://wa.me/628XXXXXXXX?text=Halo, saya tertarik dengan Tipe Standard (KM Luar) di ' + selectedGedungLuar + '. Apakah masih tersedia?'" target="_blank" class="btn-gold text-center w-full md:w-auto shadow-md">
                             <span x-text="dataKetersediaanLuar[selectedGedungLuar].tersedia > 0 ? 'Booking Sekarang' : 'Waiting List'"></span>
                        </a>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </section>

    {{-- FOOTER (Responsif) --}}
    <footer class="mt-8 px-4 md:px-8 py-8 border-t bg-white">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center gap-4 text-center md:text-left text-sm">
             <div class="flex flex-col md:flex-row items-center gap-3 md:gap-4">
                <img src="{{ asset('foto/logo.jpg') }}" alt="Logo" class="w-8 md:w-10"> 
                <p class="text-gray-600">© Kost Azka, <span id="year"></span></p>
            </div>
            <div class="text-gray-600">
                <a href="{{ url('/') }}" class="hover:text-[#c4a24c] transition-colors font-medium">Kembali ke Beranda</a>
            </div>
        </div>
    </footer>

    {{-- SCRIPT SLIDER (Tidak Berubah) --}}
    <script>
        document.getElementById("year").textContent = new Date().getFullYear();
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