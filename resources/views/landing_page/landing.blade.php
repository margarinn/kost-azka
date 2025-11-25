<!DOCTYPE html>
<html lang="en" class="scroll-smooth"> <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Azka Living</title>
    {{-- favicon for landing page --}}
    <link rel="icon" type="image/png" href="{{ asset('foto/LogoKost.png') }}">
    <link rel="shortcut icon" href="{{ asset('foto/LogoKost.png') }}">

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Tambahan agar scroll halus saat menu diklik */
        html {
            scroll-behavior: smooth;
        }
        body {
            font-family: 'Playfair Display', serif;
        }
        .btn-gold {
            background-color: #c4a24c;
            padding: 10px 20px;
            border-radius: 20px;
            color: white;
            transition: background 0.3s;
        }
        .btn-gold:hover {
            background-color: #b39240;
        }
        .gold-bg {
            background-color: #c4a24c;
        }
        .hero-image {
            height: 300px;
        }
        #mobile-menu {
            transition: all 0.3s ease-in-out;
        }
        @media (min-width: 768px) {
            .hero-image {
                height: 400px;
            }
        }

        .carousel-item {
        opacity: 0.5;         
        transform: scale(0.8) translateX(0); 
        z-index: 0;
        filter: blur(3px) brightness(0.8); 
    }

    .carousel-item.active {
        opacity: 1;
        transform: scale(1.05) translateX(0); 
        z-index: 20;
        filter: blur(0) brightness(1);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.35); 
    }


    .carousel-item.left {
        transform: scale(0.8) translateX(-90px) rotate(-3deg);
        z-index: 10;
    }
    .carousel-item.right {
        transform: scale(0.8) translateX(90px) rotate(3deg);
        z-index: 10;
    }

    @media (min-width: 768px) {
        .carousel-item.left {
            transform: scale(0.8) translateX(-450px) rotate(-5deg); 
        }
        .carousel-item.right {
            transform: scale(0.8) translateX(450px) rotate(5deg);
        }
    }
    </style>
</head>

<body class="bg-white text-gray-900 overflow-x-hidden">

    <nav class="flex justify-between items-center px-4 md:px-10 py-4 md:py-6 shadow bg-white fixed w-full top-0 z-50 transition-all duration-300">
         <div>
           <a href="/"> <img src="foto/logo.jpg" alt="Logo" class="w-10 md:w-14"></a>
         </div>
        
        <ul class="hidden md:flex gap-8">
            <li><a href="#tentang" class="nav-link hover:text-gray-600 transition-colors">Tentang</a></li>
            <li><a href="#fasilitas" class="nav-link hover:text-gray-600 transition-colors">Fasilitas</a></li>
            <li><a href="#hubungi-kami" class="nav-link hover:text-gray-600 transition-colors">Hubungi Kami</a></li>
            <li><a href="{{ url('/tipekamar') }}" class="nav-link hover:text-gray-600 transition-colors">Tipe Kamar</a></li>
        </ul>

        <div class="flex items-center gap-3">
            <a class="btn-gold text-sm md:text-base" href="#hubungi-kami">Jadwalkan Survei</a>
            
            <button id="mobile-menu-btn" class="md:hidden p-2 text-gray-800 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
    </nav>

    <div id="mobile-menu" class="hidden bg-white w-full fixed top-16 left-0 shadow-lg z-40 border-t border-gray-100">
        <ul class="flex flex-col text-center py-4 space-y-4 font-medium">
            <li><a href="#tentang" class="block py-2 hover:bg-gray-50 hover:text-[#c4a24c]">Tentang</a></li>
            <li><a href="#fasilitas" class="block py-2 hover:bg-gray-50 hover:text-[#c4a24c]">Fasilitas</a></li>
            <li><a href="#" class="block py-2 hover:bg-gray-50 hover:text-[#c4a24c]">Tipe Kamar</a></li>
            <li><a href="#hubungi-kami" class="block py-2 hover:bg-gray-50 hover:text-[#c4a24c]">Hubungi Kami</a></li>
        </ul>
    </div>

    <section class="text-center mt-24 md:mt-32 px-4 relative w-full flex flex-col items-center">
        <h1 class="text-4xl md:text-8xl font-semibold mb-10 md:mb-12">Azka Living</h1>

        <div class="relative w-full flex justify-center items-center">
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2
                        bg-[#c4a24c] rounded-[2.5rem] -z-10
                        w-[350px] h-[450px]
                        md:w-full md:max-w-6xl md:h-[400px] md:rounded-[3rem]">
            </div>

            <div class="relative bg-gray-900 shadow-2xl transition-all duration-500 ease-in-out
                        w-[300px] h-[600px] rounded-[3rem] border-[12px] border-gray-900
                        md:w-full md:max-w-5xl md:h-[550px] md:rounded-[2rem] md:border-[16px]">
                
                <div class="absolute top-3 left-1/2 transform -translate-x-1/2 
                            h-[28px] w-[90px] bg-black rounded-full z-20 
                            block md:hidden pointer-events-none">
                </div>

                <div class="absolute -left-[15px] top-[100px] h-[40px] w-[3px] bg-gray-800 rounded-l-lg block md:hidden"></div>
                <div class="absolute -left-[15px] top-[150px] h-[40px] w-[3px] bg-gray-800 rounded-l-lg block md:hidden"></div>
                <div class="absolute -right-[15px] top-[120px] h-[60px] w-[3px] bg-gray-800 rounded-r-lg block md:hidden"></div>

                <div class="h-full w-full overflow-hidden rounded-[2.3rem] md:rounded-[1rem] bg-white relative">
                    <img src="foto/depankost4.jpeg" 
                         class="w-full h-full object-cover" 
                         alt="Depan Kost">
                </div>
            </div>
        </div>
    </section>

    <section id="tentang" class="mt-16 md:mt-28 px-4 md:px-10 scroll-mt-28">
        <h2 class="text-3xl md:text-4xl font-semibold mb-5">Definisi kost ideal.</h2>
        <p class="text-gray-600 max-w-2xl">
            Kami menawarkan tempat dengan keamanan, kenyamanan, fasilitas, dan desain ruangan terbaik.
        </p>

        <div class="relative max-w-6xl mx-auto mt-6 md:mt-12 flex justify-center items-center">
            <button id="prev" class="absolute left-2 top-1/2 -translate-y-1/2 z-20 bg-white/70 hover:bg-white/90 p-3 rounded-full shadow-lg">
                ❮
            </button>
            <div class="relative w-full flex justify-center items-center h-[400px] md:h-[650px] overflow-hidden py-10">
                {{-- 
                Peningkatan: 
                1. Tinggi container diperbesar: h-[400px] (mobile), h-[650px] (desktop).
                2. Ditambahkan py-10 untuk memberi ruang napas di atas dan bawah.
                --}}

                @if(isset($fotos) && $fotos->count())
                    @foreach($fotos as $foto)
                        <img src="{{ asset('storage/' . $foto->foto_path) }}"
                            class="carousel-item absolute 
                                    w-[95%] h-[350px] {
                                    md:w-[850px] md:h-[500px] 
                                    rounded-3xl object-cover transition-all duration-700 ease-in-out shadow-2xl"
                            alt="Foto - {{ $foto->kategori ?? 'Galeri' }}">
                    @endforeach
                @else
                    {{-- Gambar Placeholder (Fallback) juga diperbesar --}}
                    <img src="foto/kamar1.jpg" class="carousel-item absolute w-[95%] h-[350px] md:w-[850px] md:h-[500px] rounded-3xl object-cover transition-all duration-700 ease-in-out shadow-2xl" alt="Kamar 1">
                    <img src="foto/kamar2.jpg" class="carousel-item absolute w-[95%] h-[350px] md:w-[850px] md:h-[500px] rounded-3xl object-cover transition-all duration-700 ease-in-out shadow-2xl" alt="Kamar 2">
                    <img src="foto/kamar3.jpg" class="carousel-item absolute w-[95%] h-[350px] md:w-[850px] md:h-[500px] rounded-3xl object-cover transition-all duration-700 ease-in-out shadow-2xl" alt="Kamar 3">
                @endif

            </div>

            <button id="next" class="absolute right-2 top-1/2 -translate-y-1/2 z-20 bg-white/70 hover:bg-white/90 p-3 rounded-full shadow-lg">
                ❯
            </button>
        </div>
    </section>

    <style>
    /* Logika Slide */
    .carousel-item {
        filter: blur(2px);
        transform: scale(0.85) translateX(0);
        z-index: 0;
        opacity: 0.6;
    }
    .carousel-item.active {
        filter: blur(0);
        transform: scale(1) translateX(0);
        z-index: 10;
        opacity: 1;
    }
    
    /* Posisi Mobile */
    .carousel-item.left {
        filter: blur(2px);
        transform: scale(0.85) translateX(-80px); 
        z-index: 5;
    }
    .carousel-item.right {
        filter: blur(2px);
        transform: scale(0.85) translateX(80px); 
        z-index: 5;
    }

    /* Posisi Desktop */
    @media (min-width: 768px) {
        .carousel-item.left {
            transform: scale(0.85) translateX(-400px);
        }
        .carousel-item.right {
            transform: scale(0.85) translateX(400px);
        }
    }
    </style>

    <section class="mt-16 md:mt-24 text-center px-4 md:px-10">
        <h2 class="text-3xl md:text-4xl font-semibold mb-5">Kenapa Kost Azka?</h2>
        <p class="text-gray-600 max-w-2xl mx-auto">
            Kami menyediakan hunian nyaman dengan lokasi strategis, harga terjangkau, dan fasilitas lengkap.
        </p>

        <a class="btn-gold inline-block mt-6" href="#hubungi-kami">Jadwalkan Survei</a>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-10 mt-10 md:mt-16 text-left">
            <div>
                <h3 class="text-lg md:text-xl font-semibold">Lokasi Strategis</h3>
                <p class="text-gray-600 text-sm md:text-base">Akses mudah ke kampus, pusat perbelanjaan, dan transportasi umum.</p>
            </div>
            <div>
                <h3 class="text-lg md:text-xl font-semibold">Interior Ruang Nyaman</h3>
                <p class="text-gray-600 text-sm md:text-base">Desain interior modern dan bersih untuk menunjang produktivitas.</p>
            </div>
            <div>
                <h3 class="text-lg md:text-xl font-semibold">Keamanan 24 Jam</h3>
                <p class="text-gray-600 text-sm md:text-base">CCTV lengkap memastikan keamanan penghuni.</p>
            </div>
            <div>
                <h3 class="text-lg md:text-xl font-semibold">Kamar Nyaman & Lengkap</h3>
                <p class="text-gray-600 text-sm md:text-base">Dilengkapi kasur, meja, AC, lemari, dan fasilitas lainnya.</p>
            </div>
        </div>
    </section>
    
    <section id="fasilitas" class="mt-20 md:mt-32 px-4 md:px-10 scroll-mt-28">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-16 items-center">
            <div class="order-2 md:order-1"> <h2 class="text-3xl md:text-4xl font-semibold mb-5">Lingkungan Kost yang Nyaman</h2>
                <p class="text-gray-600 mb-6 md:mb-8">
                    Kami menghadirkan ruang hunian dengan suasana tenang, bersih, dan tertata
                    sehingga mendukung kenyamanan dan produktivitas Anda setiap hari.
                </p>
                <ul class="space-y-3 md:space-y-4 text-gray-700 text-sm md:text-base">
                    <li>✔ Area bersih dan terawat setiap hari</li>
                    <li>✔ Suasana sejuk dan tidak bising</li>
                    <li>✔ Tempat parkir luas & aman</li>
                    <li>✔ Area komunal untuk bersantai</li>
                </ul>
                <a href="#" class="btn-gold inline-block mt-6 md:mt-8">Lihat Fasilitas</a>
            </div>
            <div class="order-1 md:order-2 w-full h-[300px] md:h-[420px] rounded-2xl md:rounded-3xl overflow-hidden shadow-lg">
                <img src="foto/lingkungan.jpeg" class="w-full h-full object-cover" alt="Lingkungan Kost">
            </div>
        </div>
    </section>
    
    <section class="mt-20 md:mt-28 px-4 md:px-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-16 items-center">
            <div class="order-1 w-full h-[350px] md:h-[450px] rounded-2xl md:rounded-3xl overflow-hidden shadow-lg">
                <img src="foto/janji.jpg" class="w-full h-full object-cover" alt="Janji Layanan">
            </div>
            <div class="order-2">
                <p class="text-xl md:text-3xl leading-relaxed"> “Prioritas utama kami adalah ketenangan Anda. 
                    Mulai dari keamanan 24 jam, lingkungan yang tenang, 
                    hingga fasilitas yang terawat. Kami berjanji memberikan 
                    layanan terbaik untuk mendukung kenyamanan studi Anda.”
                </p>
                <p class="mt-6 text-gray-600">Janji Layanan Kami</p>
            </div>
        </div>
    </section>
    
    <section id="hubungi-kami" class="mt-20 md:mt-32 px-4 md:px-10 text-center scroll-mt-28">
        <h2 class="text-3xl md:text-4xl font-semibold mb-4">Hubungi Kami</h2>
        <p class="text-gray-600 mb-8">
            Jadwalkan survey anda dengan cepat dan dapatkan layanan terbaik dari kami.
        </p>
        <a href="https://wa.me/628XXXXXXXX" target="_blank" class="btn-gold inline-block mb-10 md:mb-16">Jadwalkan Survei →</a>
        <div class="w-full max-w-5xl mx-auto">
            <div class="w-full h-[300px] md:h-[400px] rounded-2xl md:rounded-3xl overflow-hidden shadow-lg">
                <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3963.436836942715!2d106.806783!3d-6.592502!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNsKwMzUnMzMuMCJTIDEwNsKwNDgnMjQuNCJF!5e0!3m2!1sen!2sid!4v1763221625517!5m2!1sen!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
    
    <footer class="mt-20 md:mt-32 px-4 md:px-10 py-10">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row gap-4 md:gap-10 text-sm font-medium mb-8 md:mb-12">
                <a href="#tentang" class="hover:text-gray-500">Tentang Kami</a>
                <a href="#fasilitas" class="hover:text-gray-500">Fasilitas</a>
                <a href="#" class="hover:text-gray-500">Tipe Kamar</a>
            </div>
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end space-y-4 md:space-y-0">
                <div class="flex items-center gap-4">
                    <img src="foto/logo.jpg" alt="Logo" class="w-10 md:w-14"> <p class="text-sm text-gray-600">
                        © Kost Azka, <span id="year"></span>
                    </p>
                </div>
                <p class="text-sm text-gray-600">All Rights Reserved</p>
            </div>
        </div>
    </footer>

    <script>
    // --- SCRIPT 1: CAROUSEL ---
    const items = document.querySelectorAll('.carousel-item');
    let current = 0;
    let slideInterval;

    function update() {
        if(items.length === 0) return;
        items.forEach((item, i) => {
            item.classList.remove('left','right','active');
            if(i === current) item.classList.add('active');
            else if(i === (current - 1 + items.length) % items.length) item.classList.add('left');
            else if(i === (current + 1) % items.length) item.classList.add('right');
            else item.style.transform = 'scale(0.85) translateX(0)'; 
        });
    }

    function startAutoSlide() {
        if(items.length === 0) return;
        slideInterval = setInterval(() => {
            current = (current + 1) % items.length;
            update();
        }, 5000);
    }

    function resetTimer() {
        clearInterval(slideInterval);
        startAutoSlide();
    }

    if(items.length > 0) {
        document.getElementById('prev').addEventListener('click', () => {
            current = (current - 1 + items.length) % items.length;
            update();
            resetTimer();
        });
        document.getElementById('next').addEventListener('click', () => {
            current = (current + 1) % items.length;
            update();
            resetTimer();
        });
    }

    const menuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');

    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    document.querySelectorAll('#mobile-menu a').forEach(link => {
        link.addEventListener('click', () => {
            mobileMenu.classList.add('hidden');
        });
    });

    document.getElementById("year").textContent = new Date().getFullYear();

    window.addEventListener('load', () => {
        update();
        startAutoSlide();
    });

    const sections = document.querySelectorAll("section");
    const navLinks = document.querySelectorAll(".nav-link"); 

    window.addEventListener("scroll", () => {
        let currentSection = "";

        sections.forEach((section) => {
            if(section.getAttribute("id")) {
                const sectionTop = section.offsetTop;
                if (scrollY >= sectionTop - 150) {
                    currentSection = section.getAttribute("id");
                }
            }
        });

        navLinks.forEach((link) => {
            link.classList.remove("text-[#c4a24c]", "font-bold");
            

            if (currentSection && link.getAttribute("href").includes(currentSection)) {
                link.classList.add("text-[#c4a24c]", "font-bold");
            }
        });
    });
    </script>
</body>
</html>