<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            
            <div class="bg-gray-50 p-5 rounded-lg shadow-sm border border-gray-200">
                <h3 class="text-sm font-medium text-gray-500">Kamar Terisi</h3>
                <p class="mt-1 text-2xl font-bold text-gray-900">
                    {{ $kamarTerisi }} / {{ $totalKamar }}
                </p>
                <span class="text-sm text-green-600">kamar</span>
            </div>
            
            <div class="bg-gray-50 p-5 rounded-lg shadow-sm border border-gray-200">
                <h3 class="text-sm font-medium text-gray-500">Kamar Kosong</h3>
                <p class="mt-1 text-2xl font-bold text-gray-900">
                    {{ $kamarKosong }}
                </p>
                <span class="text-sm text-blue-600">kamar tersedia</span>
            </div>
            
            <div class="bg-gray-50 p-5 rounded-lg shadow-sm border border-gray-200">
                <h3 class="text-sm font-medium text-gray-500">Kamar Dalam Perbaikan</h3>
                <p class="mt-1 text-2xl font-bold text-gray-900">
                    {{ $kamarPerbaikan }}
                </p>
                <span class="text-sm text-red-600">kamar</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            
            <div class="bg-gray-50 p-5 rounded-lg shadow-sm border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Status Kamar</h3>
                
                <div class="relative h-56"> 
                    <canvas id="statusKamarChart"></canvas>
                </div>
                
                <div class="mt-4 grid grid-cols-3 gap-2 text-center">
                    <div>
                        <span class="block w-3 h-3 bg-green-500 mx-auto rounded-full"></span>
                        <span class="text-xs">Terisi ({{ $kamarTerisi }})</span>
                    </div>
                    <div>
                        <span class="block w-3 h-3 bg-blue-500 mx-auto rounded-full"></span>
                        <span class="text-xs">Kosong ({{ $kamarKosong }})</span>
                    </div>
                    <div>
                        <span class="block w-3 h-3 bg-red-500 mx-auto rounded-full"></span>
                        <span class="text-xs">Perbaikan ({{ $kamarPerbaikan }})</span>
                    </div>
                </div>
            </div>
            
            <div class="bg-gray-50 p-5 rounded-lg shadow-sm border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Daftar Kamar Kosong</h3>
                <div class="overflow-y-auto h-60">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No. Kamar</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Gedung</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Kamar Mandi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($daftarKamarKosong as $kamar)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $kamar->nomor_kamar }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $kamar->gedung }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $kamar->jenis_kamar_mandi }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                        Tidak ada kamar kosong.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<script>
    (function() {
        const dataTerisi = @json($kamarTerisi);
        const dataKosong = @json($kamarKosong);
        const dataPerbaikan = @json($kamarPerbaikan);

        const data = {
            labels: [
                'Terisi',
                'Kosong',
                'Perbaikan'
            ],
            datasets: [{
                label: 'Status Kamar',
                data: [dataTerisi, dataKosong, dataPerbaikan],
                backgroundColor: [
                    '#22C55E', 
                    '#3B82F6', 
                    '#EF4444'  
                ],
                hoverOffset: 4
            }]
        };

        const ctx = document.getElementById('statusKamarChart').getContext('2d');

        const statusKamarChart = new Chart(ctx, {
            type: 'pie', 
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false, 
                plugins: {
                    legend: {
                        display: false 
                                       
                    }
                }
            }
        });
    })();
</script>
</x-app-layout>