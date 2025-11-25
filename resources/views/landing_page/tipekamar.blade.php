<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tipe Kamar - Azka Living</title>
    <link rel="icon" type="image/png" href="{{ asset('foto/LogoKost.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Playfair Display', serif; }
        .btn-gold {
            background-color: #c4a24c; padding: 10px 20px; border-radius: 20px; color: white; transition: background 0.3s;
        }
        .btn-gold:hover { background-color: #b39240; }
        .text-gold { color: #c4a24c; }
        
        /* Tambahan style untuk tombol navigasi slider */
        .slider-btn {
            background-color: rgba(255, 255, 255, 0.7);
            color: #333;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
        }
        .slider-btn:hover {
            background-color: white;
            color: #c4a24c;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-900">

    <nav class="flex justify-between items-center px-4 md:px-10 py-4 md:py-6 shadow bg-white fixed w-full top-0 z-50">
         <div>
           <a href="{{ url('/') }}"> 
               <img src="{{ asset('foto/logo.jpg') }}" alt="Logo" class="w-10 md:w-14">
           </a>
         </div>
        
        <ul class="hidden md:flex gap-8">
            <li><a href="{{ url('/') }}#tentang" class="hover:text-gray-600">Tentang</a></li>
            <li><a href="{{ url('/') }}#fasilitas" class="hover:text-gray-600">Fasilitas</a></li>
            <li><a href="{{ url('/') }}#hubungi-kami" class="hover:text-gray-600">Hubungi Kami</a></li>
            <li><a href="{{ url('/tipe-kamar') }}" class="text-[#c4a24c] font-bold">Tipe Kamar</a></li>
        </ul>

        <div class="flex items-center gap-3">
            <a class="btn-gold text-sm md:text-base" href="{{ url('/') }}#hubungi-kami">Jadwalkan Survei</a>
        </div>
    </nav>

    <section class="pt-32 pb-20 px-4 md:px-10">
        
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h1 class="text-4xl md:text-6xl font-semibold mb-6 text-gray-900">Pilihan Tipe Kamar</h1>
            <p class="text-gray-600 text-lg leading-relaxed">
                Azka Living menyediakan dua pilihan tipe kamar yang dirancang untuk kenyamanan Anda. 
                Pilih antara privasi total dengan kamar mandi dalam, atau opsi hemat dengan kamar mandi luar yang terawat.
            </p>
        </div>

        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-10 md:gap-16 items-start">

            <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-2xl border border-gray-100 transform hover:-translate-y-2 transition-all duration-300">
                <div class="relative h-72 md:h-[400px] group">
                    
                    <img id="img-premium" src="{{ asset('foto/kamar1.jpg') }}" alt="Kamar Mandi Dalam" class="w-full h-full object-cover transition-opacity duration-300">
                    
                    <div class="absolute top-4 right-4 bg-[#c4a24c] text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg z-10">
                        RECOMMENDED
                    </div>

                    <button onclick="changeSlide('premium', -1)" class="slider-btn absolute left-4 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 z-20">
                        ❮
                    </button>
                    <button onclick="changeSlide('premium', 1)" class="slider-btn absolute right-4 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 z-20">
                        ❯
                    </button>
                </div>
                
                <div class="p-8 md:p-10">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h2 class="text-3xl font-bold mb-1">Tipe Premium</h2>
                            <p class="text-[#c4a24c] font-semibold tracking-wider text-sm">KAMAR MANDI DALAM</p>
                        </div>
                    </div>

                    <p class="text-gray-600 mb-8 leading-relaxed">
                        Nikmati privasi maksimal tanpa harus keluar kamar. Cocok untuk Anda yang menginginkan ketenangan ekstra dan fasilitas eksklusif.
                    </p>

                    <h3 class="font-bold text-lg mb-4 border-b pb-2">Fasilitas Unggulan:</h3>
                    <ul class="grid grid-cols-1 md:grid-cols-2 gap-y-3 gap-x-4 mb-8 text-gray-700">
                        <li class="flex items-center gap-2"><span class="text-[#c4a24c]">✔</span> Kamar Mandi Pribadi</li>
                        <li class="flex items-center gap-2"><span class="text-[#c4a24c]">✔</span> Full AC Dingin</li>
                        <li class="flex items-center gap-2"><span class="text-[#c4a24c]">✔</span> Kasur Springbed Premium</li>
                        <li class="flex items-center gap-2"><span class="text-[#c4a24c]">✔</span> Lemari & Meja Belajar</li>
                        <li class="flex items-center gap-2"><span class="text-[#c4a24c]">✔</span> Free WiFi High Speed</li>
                        <li class="flex items-center gap-2"><span class="text-[#c4a24c]">✔</span> Token Listrik Sendiri</li>
                    </ul>

                    <div class="bg-gray-50 p-6 rounded-2xl flex flex-col md:flex-row justify-between items-center gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Harga mulai dari</p>
                            <p class="text-3xl font-bold text-gray-900">Rp 1.500.000<span class="text-sm font-normal text-gray-500">/bln</span></p>
                        </div>
                        <a href="https://wa.me/628XXXXXXXX?text=Halo,%20saya%20tertarik%20dengan%20Tipe%20Premium%20(KM%20Dalam)" target="_blank" class="btn-gold text-center w-full md:w-auto px-8 shadow-lg">
                            Booking Sekarang
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-xl border border-gray-100 transform hover:-translate-y-2 transition-all duration-300">
                <div class="relative h-72 md:h-[400px] group">
                    
                    <img id="img-standard" src="{{ asset('foto/kamar2.jpg') }}" alt="Kamar Mandi Luar" class="w-full h-full object-cover transition-opacity duration-300">
                    
                    <button onclick="changeSlide('standard', -1)" class="slider-btn absolute left-4 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 z-20">
                        ❮
                    </button>
                    <button onclick="changeSlide('standard', 1)" class="slider-btn absolute right-4 top-1/2 -translate-y-1/2 opacity-0 group-hover:opacity-100 z-20">
                        ❯
                    </button>
                </div>
                
                <div class="p-8 md:p-10">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h2 class="text-3xl font-bold mb-1">Tipe Standard</h2>
                            <p class="text-gray-500 font-semibold tracking-wider text-sm">KAMAR MANDI LUAR</p>
                        </div>
                    </div>

                    <p class="text-gray-600 mb-8 leading-relaxed">
                        Pilihan cerdas dan hemat. Fasilitas kamar mandi luar yang bersih, terawat, dan jumlahnya memadai menjamin kenyamanan Anda.
                    </p>

                    <h3 class="font-bold text-lg mb-4 border-b pb-2">Fasilitas Unggulan:</h3>
                    <ul class="grid grid-cols-1 md:grid-cols-2 gap-y-3 gap-x-4 mb-8 text-gray-700">
                        <li class="flex items-center gap-2"><span class="text-gray-400">✔</span> Kamar Mandi Luar Bersih</li>
                        <li class="flex items-center gap-2"><span class="text-gray-400">✔</span> Kipas Angin / AC (Opsional)</li>
                        <li class="flex items-center gap-2"><span class="text-gray-400">✔</span> Kasur Nyaman</li>
                        <li class="flex items-center gap-2"><span class="text-gray-400">✔</span> Lemari Pakaian</li>
                        <li class="flex items-center gap-2"><span class="text-gray-400">✔</span> Free WiFi High Speed</li>
                        <li class="flex items-center gap-2"><span class="text-gray-400">✔</span> Akses Dapur Bersama</li>
                    </ul>

                    <div class="bg-gray-50 p-6 rounded-2xl flex flex-col md:flex-row justify-between items-center gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Harga mulai dari</p>
                            <p class="text-3xl font-bold text-gray-900">Rp 800.000<span class="text-sm font-normal text-gray-500">/bln</span></p>
                        </div>
                        <a href="https://wa.me/628XXXXXXXX?text=Halo,%20saya%20tertarik%20dengan%20Tipe%20Standard%20(KM%20Luar)" target="_blank" class="bg-gray-800 hover:bg-gray-900 text-white px-8 py-3 rounded-2xl transition-all shadow-lg text-center w-full md:w-auto">
                            Booking Sekarang
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <footer class="mt-10 px-4 md:px-10 py-10 border-t bg-white">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center">
             <div class="flex items-center gap-4 mb-4 md:mb-0">
                <img src="{{ asset('foto/logo.jpg') }}" alt="Logo" class="w-10 md:w-14"> 
                <p class="text-sm text-gray-600">© Kost Azka, <span id="year"></span></p>
            </div>
            <div class="text-sm text-gray-600">
                <a href="{{ url('/') }}" class="hover:text-[#c4a24c] transition-colors">Kembali ke Beranda</a>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById("year").textContent = new Date().getFullYear();

        // --- KONFIGURASI GAMBAR SLIDER ---
        // Silakan tambahkan nama file foto lain di dalam array ini
        const images = {
            premium: [
                "{{ asset('foto/kamar1.jpg') }}",
                "{{ asset('foto/kamar2.jpg') }}", 
                "{{ asset('foto/kamar3.jpg') }}"  
            ],
            standard: [
                "{{ asset('foto/kamar3.jpg') }}",
                "{{ asset('foto/kamar2.jpg') }}", 
                "{{ asset('foto/kamar1.jpg') }}"  
            ]
        };

        let currentIndex = {
            premium: 0,
            standard: 0
        };

        function changeSlide(type, direction) {
            let newIndex = currentIndex[type] + direction;

            if (newIndex >= images[type].length) {
                newIndex = 0;
            } else if (newIndex < 0) {
                newIndex = images[type].length - 1;
            }

            currentIndex[type] = newIndex;

            const imgElement = document.getElementById(`img-${type}`);
            
            imgElement.style.opacity = 0;
            
            setTimeout(() => {
                imgElement.src = images[type][newIndex];
                imgElement.style.opacity = 1;
            }, 150); // Waktu yang sama dengan durasi CSS transition
        }
    </script>
</body>
</html>