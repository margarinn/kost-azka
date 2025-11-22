<nav class="w-64 bg-gray-100 p-5 shadow-lg">
    <a href="{{ route('admin.dashboard') }}" class="block text-center mb-8">
        <img src="{{ asset('images/logo_kost_azka.png') }}" alt="Kost Azka Logo" class="h-20 mx-auto">
    </a>
    
    <ul>
        <li class="mb-2">
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center p-3 rounded-lg 
               {{ request()->routeIs('dashboard') ? 'bg-[#C6A74D] text-white font-bold' : 'text-gray-700 hover:bg-[#d6bf66]' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Dashboard
            </a>
        </li>
        <li class="mb-2">
            <a href="{{ route('admin.kamar.index') }}" 
               class="flex items-center p-3 rounded-lg 
               {{ request()->routeIs('kamar.*') ? 'bg-[#C6A74D] text-white font-bold' : 'text-gray-700 hover:bg-[#d6bf66]' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                Informasi Kamar
            </a>
        </li>
        <li class="mb-2">
            <a href="{{ route('admin.galeri.index') }}" 
               class="flex items-center p-3 rounded-lg 
               {{ request()->routeIs('galeri.*') ? 'bg-[#C6A74D] text-white font-bold' : 'text-gray-700 hover:bg-[#d6bf66]' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Galeri Kost
            </a>
        </li>
    </ul>
</nav>