<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        
        <div class="mb-10 flex flex-col md:flex-row justify-between items-start md:items-end gap-4">
            <div>
                <h2 class="text-3xl font-black text-slate-900 tracking-tighter italic uppercase">Laporan Eksekutif Manager</h2>
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-[0.3em] mt-1">Ringkasan Performa Finansial & Operasional SIPKKC</p>
            </div>
            
            <a href="{{ route('manager.edit.admin') }}" class="bg-slate-900 hover:bg-indigo-600 text-white px-6 py-3 rounded-2xl font-black text-[10px] uppercase italic tracking-widest flex items-center gap-2 transition-all shadow-xl shadow-slate-200 active:scale-95">
                <i class="fa-solid fa-user-shield"></i> Pengaturan Akun Admin
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-gradient-to-br from-indigo-600 to-violet-700 rounded-[3rem] p-8 text-white shadow-2xl shadow-indigo-200 relative overflow-hidden">
                <i class="fa-solid fa-wallet absolute -right-4 -bottom-4 text-white/10 text-9xl"></i>
                <p class="text-[10px] font-black uppercase tracking-widest opacity-80 italic">Total Pendapatan Terkumpul</p>
                <h3 class="text-4xl font-black mt-2 italic tracking-tighter">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</h3>
                <div class="mt-6 inline-flex items-center gap-2 bg-white/20 backdrop-blur-md px-3 py-1 rounded-full">
                    <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                    <span class="text-[9px] font-black uppercase italic">Update Otomatis</span>
                </div>
            </div>

            <div class="bg-white rounded-[3rem] p-8 border border-slate-100 shadow-xl shadow-slate-100 flex justify-between items-center">
                <div class="flex-1">
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">Okupansi Kamar</p>
                    <h3 class="text-4xl font-black text-slate-900 mt-2 italic">{{ $okupansi }}<span class="text-sm text-slate-300 font-bold not-italic"> /{{ $total_kamar }} Unit</span></h3>
                    <div class="w-full bg-slate-100 h-2 rounded-full mt-4 overflow-hidden">
                        <div class="bg-indigo-600 h-2 rounded-full transition-all duration-1000" style="width: {{ $persen_okupansi }}%"></div>
                    </div>
                </div>
                <div class="text-indigo-600 bg-indigo-50 w-16 h-16 rounded-3xl flex items-center justify-center ml-4">
                    <i class="fa-solid fa-bed text-2xl"></i>
                </div>
            </div>

            <div class="bg-white rounded-[3rem] p-8 border border-slate-100 shadow-xl shadow-slate-100 flex justify-between items-center">
                <div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">Catering Aktif</p>
                    <h3 class="text-4xl font-black text-slate-900 mt-2 italic">
                        {{ $total_catering }}
                        <span class="text-sm text-slate-300 font-bold not-italic uppercase ml-2">Pelanggan</span>
                    </h3>
                    <p class="text-[9px] font-bold text-emerald-500 uppercase mt-4 italic">Layanan Berjalan Lancar</p>
                </div>
                <div class="text-rose-500 bg-rose-50 w-16 h-16 rounded-3xl flex items-center justify-center">
                    <i class="fa-solid fa-utensils text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[3rem] p-10 border border-slate-100 shadow-2xl shadow-slate-100 mb-10">
            <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
                <div>
                    <h4 class="text-xl font-black text-slate-800 italic uppercase tracking-tighter">Tren Pendapatan Bulanan</h4>
                    <p class="text-[10px] font-bold text-slate-400 uppercase italic">Perbandingan laba kotor tahun {{ date('Y') }}</p>
                </div>
                <a href="{{ route('manager.cetak') }}" target="_blank" class="bg-slate-900 hover:bg-slate-800 text-white px-8 py-3 rounded-2xl font-black text-[10px] uppercase italic tracking-widest flex items-center gap-2 transition-all shadow-xl shadow-slate-200">
                    <i class="fa-solid fa-print"></i> Cetak Laporan
                </a>
            </div>
            
            <div class="h-[400px]">
                <canvas id="incomeChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('incomeChart').getContext('2d');
            
            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(99, 102, 241, 0.4)');
            gradient.addColorStop(1, 'rgba(99, 102, 241, 0.0)');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: {!! json_encode($labels) !!},
                    datasets: [{
                        label: 'Pendapatan (Rp)',
                        data: {!! json_encode($totals) !!},
                        borderColor: '#6366f1',
                        backgroundColor: gradient,
                        borderWidth: 4,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 6,
                        pointBackgroundColor: '#6366f1',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointHoverRadius: 8
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            backgroundColor: '#1e293b',
                            titleFont: { size: 12, weight: 'bold' },
                            bodyFont: { size: 12 },
                            padding: 12,
                            displayColors: false,
                            callbacks: {
                                label: function(context) {
                                    return 'Rp ' + context.parsed.y.toLocaleString('id-ID');
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: '#f1f5f9' },
                            ticks: {
                                font: { size: 10, weight: 'bold' },
                                callback: function(value) {
                                    return 'Rp ' + (value / 1000000) + ' Jt';
                                }
                            }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { font: { size: 10, weight: 'bold' } }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>