<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipe Kamar - Azka Living</title>
    <link rel="icon" type="image/png" href="{{ asset('foto/LogoKost.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        body { font-family: 'Playfair Display', serif; }
        .btn-gold { background-color: #c4a24c; padding: 8px 16px; border-radius: 20px; color: white; transition: background 0.3s; font-size: 0.9rem; } /* Padding & Font Size dikurangi */
        .btn-gold:hover { background-color: #b39240; }
        .text-gold { color: #c4a24c; }
        .slider-btn { background-color: rgba(255, 255, 255, 0.7); color: #333; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.3s; } /* Ukuran slider btn dikurangi */
        .slider-btn:hover { background-color: white; color: #c4a24c; }
        .gedung-btn.active { background-color: #c4a24c; color: white; border-color: #c4a24c; }
        /* Mengurangi ukuran teks dan padding tombol gedung */
        .gedung-btn { padding: 6px 12px; font-size: 0.85rem; }
    </style>
</head>

<body class="bg-gray-50 text-gray-900">

    {{-- NAVBAR (Padding dikurangi sedikit) --}}
    <nav class="flex justify-between items-center px-4 md:px-8 py-3 md:py-4 shadow bg-white fixed w-full top-0 z-50">
         <div><a href="{{ url('/') }}"><img src="{{ asset('foto/logo.jpg') }}" alt="Logo" class="w-8 md:w-12"></a></div>
        <ul class="hidden md:flex gap-6 text-sm md:text-base">
            <li><a href="{{ url('/') }}#tentang" class="hover:text-gray-600">Tentang</a></li>
            <li><a href="{{ url('/') }}#fasilitas" class="hover:text-gray-600">Fasilitas</a></li>
            <li><a href="{{ url('/') }}#hubungi-kami" class="hover:text-gray-600">Hubungi Kami</a></li>
            <li><a href="{{ route('landing_page.tipekamar') }}" class="text-[#c4a24c] font-bold">Tipe Kamar</a></li>
        </ul>
        <div class="flex items-center gap-3"><a class="btn-gold" href="{{ url('/') }}#hubungi-kami">Jadwalkan Survei</a></div>
    </nav>

    <section class="pt-24 pb-16 px-4 md:px-8"> 
        <div class="text-center max-w-2xl mx-auto mb-12"> 
            <h1 class="text-3xl md:text-5xl font-semibold mb-4 text-gray-900">Pilihan Tipe Kamar</h1> 
            <p class="text-gray-600 text-base leading-relaxed"> 
                Azka Living menyediakan dua pilihan tipe kamar yang dirancang untuk kenyamanan Anda. Pilih antara privasi total dengan kamar mandi dalam, atau opsi hemat dengan kamar mandi luar yang terawat.
            </p>
        </div>

        <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8 md:gap-12 items-start"> 


            @if(count($dataDalam) > 0)
            <div x-data="{ 
                    selectedGedung: '{{ array_key_first($dataDalam) }}', 
                    dataKetersediaan: {{ json_encode($dataDalam) }},
                    formatRupiah(angka) { return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka); }
                 }" 
                 class="bg-white rounded-[2rem] overflow-hidden shadow-xl border border-gray-100 transform hover:-translate-y-1 transition-all duration-300"> {{-- Rounded, shadow, hover translate dikurangi --}}

                <div class="relative h-56 md:h-72 group"> 
                    <img id="img-premium" src="{{ asset('storage/' . ($fotoDalam[0] ?? 'placeholder.jpg')) }}" alt="Kamar Mandi Dalam" class="w-full h-full object-cover transition-opacity duration-300">
                    <div class="absolute top-3 right-3 bg-[#c4a24c] text-white px-3 py-1 rounded-full text-xs font-bold shadow-sm z-10">RECOMMENDED</div>
                    @if(count($fotoDalam) > 1)
                        <button onclick="changeSlide('premium', -1)" class="slider-btn absolute left-3 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 z-20">❮</button>
                        <button onclick="changeSlide('premium', 1)" class="slider-btn absolute right-3 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 z-20">❯</button>
                    @endif
                </div>
                
                <div class="p-6 md:p-8"> 
                    <div class="mb-4">
                        <h2 class="text-2xl font-bold mb-1">Tipe Premium</h2>
                        <p class="text-[#c4a24c] font-semibold tracking-wider text-xs">KAMAR MANDI DALAM</p> 
                    </div>

                    <div class="mb-5">
                        <h3 class="font-bold text-gray-700 mb-2 text-sm">Pilih Lokasi Gedung:</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($dataDalam as $gedung => $info)
                                <button @click="selectedGedung = '{{ $gedung }}'" :class="{ 'active': selectedGedung === '{{ $gedung }}' }" class="gedung-btn rounded-full border-2 border-gray-300 text-gray-600 font-medium transition-all hover:border-[#c4a24c] hover:text-[#c4a24c]">{{ $gedung }}</button>
                            @endforeach
                        </div>
                    </div>

                    {{-- STATUS KETERSEDIAAN (Padding & Margin dikurangi) --}}
                    <div class="mb-6 p-3 bg-gray-50 rounded-lg border border-gray-100 flex justify-between items-center">
                        <h3 class="font-bold text-gray-700 text-sm" x-text="'Status di ' + selectedGedung + ':'"></h3>
                        
                        <div x-show="dataKetersediaan[selectedGedung].tersedia > 0" class="flex items-center text-green-600 font-semibold text-base"> {{-- Font size dikurangi --}}
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span x-text="dataKetersediaan[selectedGedung].tersedia + ' Tersedia'"></span>
                        </div>
                        
                        <div x-show="dataKetersediaan[selectedGedung].tersedia == 0" class="flex items-center text-red-500 font-semibold text-base">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span>Full</span>
                        </div>
                    </div>
                    
                    <h3 class="font-bold text-base mb-3 border-b pb-1">Fasilitas Unggulan:</h3> {{-- Font size & margin dikurangi --}}
                    <ul class="grid grid-cols-1 gap-y-2 gap-x-4 mb-6 text-sm text-gray-700"> {{-- Gap & Font size dikurangi --}}
                        <li class="flex items-center gap-2"><span class="text-[#c4a24c]">✔</span> Kamar Mandi Pribadi</li>
                        <li class="flex items-center gap-2"><span class="text-[#c4a24c]">✔</span> Full AC Dingin</li>
                        <li class="flex items-center gap-2"><span class="text-[#c4a24c]">✔</span> WiFi High Speed</li>
                        <li class="flex items-center gap-2"><span class="text-[#c4a24c]">✔</span> Dapur Bersama</li>
                    </ul>

                    <div class="bg-gray-50 p-4 rounded-xl flex flex-col md:flex-row justify-between items-center gap-3"> {{-- Padding & gap dikurangi --}}
                        <div>
                            <p class="text-xs text-gray-500">Harga mulai dari</p>
                            <p class="text-2xl font-bold text-gray-900"> {{-- Font size dikurangi --}}
                                <span x-text="formatRupiah(dataKetersediaan[selectedGedung].harga_mulai)"></span>
                                <span class="text-xs font-normal text-gray-500">/bln</span>
                            </p>
                        </div>
                        <a :href="'https://wa.me/628XXXXXXXX?text=Halo, saya tertarik dengan Tipe Premium (KM Dalam) di ' + selectedGedung + '. Apakah masih tersedia?'" target="_blank" class="btn-gold text-center w-full md:w-auto shadow-md">
                            <span x-text="dataKetersediaan[selectedGedung].tersedia > 0 ? 'Booking Sekarang' : 'Waiting List'"></span>
                        </a>
                    </div>
                </div>
            </div>
            @endif

            {{-- ================= TIPE STANDARD (KM LUAR) ================= --}}
            {{-- Menerapkan pengurangan ukuran yang sama persis --}}
            @if(count($dataLuar) > 0)
            <div x-data="{ 
                    selectedGedungLuar: '{{ array_key_first($dataLuar) }}', 
                    dataKetersediaanLuar: {{ json_encode($dataLuar) }},
                    formatRupiah(angka) { return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka); }
                 }"
                 class="bg-white rounded-[2rem] overflow-hidden shadow-md border border-gray-100 transform hover:-translate-y-1 transition-all duration-300">
                
                <div class="relative h-56 md:h-72 group">
                    <img id="img-standard" src="{{ asset('storage/' . ($fotoLuar[0] ?? 'placeholder.jpg')) }}" alt="Kamar Mandi Luar" class="w-full h-full object-cover transition-opacity duration-300">
                    @if(count($fotoLuar) > 1)
                        <button onclick="changeSlide('standard', -1)" class="slider-btn absolute left-3 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 z-20">❮</button>
                        <button onclick="changeSlide('standard', 1)" class="slider-btn absolute right-3 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 z-20">❯</button>
                    @endif
                </div>
                
                <div class="p-6 md:p-8">
                    <div class="mb-4">
                        <h2 class="text-2xl font-bold mb-1">Tipe Standard</h2>
                        <p class="text-gray-500 font-semibold tracking-wider text-xs">KAMAR MANDI LUAR</p>
                    </div>

                    <div class="mb-5">
                        <h3 class="font-bold text-gray-700 mb-2 text-sm">Pilih Lokasi Gedung:</h3>
                        <div class="flex flex-wrap gap-2">
                            @foreach($dataLuar as $gedung => $info)
                                <button @click="selectedGedungLuar = '{{ $gedung }}'" :class="{ 'active': selectedGedungLuar === '{{ $gedung }}' }" class="gedung-btn rounded-full border-2 border-gray-300 text-gray-600 font-medium transition-all hover:border-[#c4a24c] hover:text-[#c4a24c]">{{ $gedung }}</button>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-6 p-3 bg-gray-50 rounded-lg border border-gray-100 flex justify-between items-center">
                        <h3 class="font-bold text-gray-700 text-sm" x-text="'Status di ' + selectedGedungLuar + ':'"></h3>
                        <div x-show="dataKetersediaanLuar[selectedGedungLuar].tersedia > 0" class="flex items-center text-green-600 font-semibold text-base">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span x-text="dataKetersediaanLuar[selectedGedungLuar].tersedia + ' Tersedia'"></span>
                        </div>
                        <div x-show="dataKetersediaanLuar[selectedGedungLuar].tersedia == 0" class="flex items-center text-red-500 font-semibold text-base">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            <span>Full</span>
                        </div>
                    </div>
                    
                     <h3 class="font-bold text-base mb-3 border-b pb-1">Fasilitas Unggulan:</h3>
                    <ul class="grid grid-cols-1 gap-y-2 gap-x-4 mb-6 text-sm text-gray-700">
                        <li class="flex items-center gap-2"><span class="text-gray-400">✔</span> Kamar Mandi Luar Bersih</li>
                        <li class="flex items-center gap-2"><span class="text-gray-400">✔</span> Kipas Angin / AC (Opsional)</li>
                        <li class="flex items-center gap-2"><span class="text-gray-400">✔</span> WiFi High Speed</li>
                        <li class="flex items-center gap-2"><span class="text-gray-400">✔</span> Dapur Bersama </li>
                    </ul>

                    <div class="bg-gray-50 p-4 rounded-xl flex flex-col md:flex-row justify-between items-center gap-3">
                        <div>
                            <p class="text-xs text-gray-500">Harga mulai dari</p>
                            <p class="text-2xl font-bold text-gray-900">
                                <span x-text="formatRupiah(dataKetersediaanLuar[selectedGedungLuar].harga_mulai)"></span>
                                <span class="text-xs font-normal text-gray-500">/bln</span>
                            </p>
                        </div>
                        <a :href="'https://wa.me/628XXXXXXXX?text=Halo, saya tertarik dengan Tipe Standard (KM Luar) di ' + selectedGedungLuar + '. Apakah masih tersedia?'" target="_blank" class="bg-gray-800 hover:bg-gray-900 text-white px-6 py-2 rounded-full transition-all shadow-md text-center w-full md:w-auto text-sm">
                             <span x-text="dataKetersediaanLuar[selectedGedungLuar].tersedia > 0 ? 'Booking Sekarang' : 'Waiting List'"></span>
                        </a>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </section>

    {{-- FOOTER & SCRIPT (Sama seperti sebelumnya, hanya padding footer dikurangi sedikit) --}}
    <footer class="mt-8 px-4 md:px-8 py-8 border-t bg-white">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center text-sm">
             <div class="flex items-center gap-3 mb-3 md:mb-0"><img src="{{ asset('foto/logo.jpg') }}" alt="Logo" class="w-8 md:w-10"> <p class="text-gray-600">© Kost Azka, <span id="year"></span></p></div>
            <div class="text-gray-600"><a href="{{ url('/') }}" class="hover:text-[#c4a24c] transition-colors">Kembali ke Beranda</a></div>
        </div>
    </footer>

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