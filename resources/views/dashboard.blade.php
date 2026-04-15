<?php

use Illuminate\Support\Facades\Auth; ?>
<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div
                class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4 bg-gradient-to-r from-blue-600 to-indigo-700 text-white overflow-hidden relative">
                <div class="z-10">
                    <h2 class="text-2xl font-bold mb-1">Selamat Datang, {{ Auth::user()->name }}! 👋</h2>
                    <p class="text-blue-100 text-sm">Ini adalah ringkasan sirkulasi dan inventaris laboratorium hari
                        ini.</p>
                </div>
                <div class="z-10 flex gap-3">
                    <a href="{{ route('peminjaman.create') }}"
                        class="bg-white/20 hover:bg-white/30 border border-white/30 backdrop-blur-sm text-white px-4 py-2 rounded-lg text-sm font-semibold transition-colors">
                        + Peminjaman Alat
                    </a>
                    <a href="{{ route('permintaan.create') }}"
                        class="bg-white text-blue-700 hover:bg-gray-50 px-4 py-2 rounded-lg text-sm font-bold shadow-sm transition-colors">
                        + Permintaan Bahan
                    </a>
                </div>
                <svg class="absolute -right-6 -bottom-6 w-48 h-48 text-white/10" fill="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                    </path>
                </svg>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div
                    class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div
                        class="w-14 h-14 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-500 mb-0.5">Total Stok Barang</p>
                        <h3 class="text-2xl font-bold text-gray-900">{{ number_format($totalBarang) }} <span
                                class="text-sm font-medium text-gray-400">Item</span></h3>
                    </div>
                </div>

                <div
                    class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition-shadow">
                    <div
                        class="w-14 h-14 rounded-xl bg-cyan-50 text-cyan-600 flex items-center justify-center shrink-0">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-500 mb-0.5">Sedang Dipinjam</p>
                        <h3 class="text-2xl font-bold text-gray-900">{{ number_format($peminjamanAktif) }} <span
                                class="text-sm font-medium text-gray-400">Transaksi</span></h3>
                    </div>
                </div>

                <div
                    class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition-shadow relative overflow-hidden">
                    <div
                        class="w-14 h-14 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-500 mb-0.5">Pinjaman Pending</p>
                        <h3 class="text-2xl font-bold text-gray-900">{{ number_format($peminjamanPending) }} <span
                                class="text-sm font-medium text-gray-400">Antrean</span></h3>
                    </div>
                    @if($peminjamanPending > 0)
                    <div class="absolute top-0 right-0 w-3 h-3 bg-red-500 rounded-full mt-4 mr-4 animate-ping"></div>
                    <div class="absolute top-0 right-0 w-3 h-3 bg-red-500 rounded-full mt-4 mr-4"></div>
                    @endif
                </div>

                <div
                    class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition-shadow relative overflow-hidden">
                    <div
                        class="w-14 h-14 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-500 mb-0.5">Permintaan Bahan Pending</p>
                        <h3 class="text-2xl font-bold text-gray-900">{{ number_format($permintaanPending) }} <span
                                class="text-sm font-medium text-gray-400">Antrean</span></h3>
                    </div>
                    @if($permintaanPending > 0)
                    <div class="absolute top-0 right-0 w-3 h-3 bg-red-500 rounded-full mt-4 mr-4 animate-ping"></div>
                    <div class="absolute top-0 right-0 w-3 h-3 bg-red-500 rounded-full mt-4 mr-4"></div>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 lg:col-span-2">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-base font-bold text-gray-900">Statistik Transaksi (6 Bulan Terakhir)</h3>
                    </div>
                    <div id="chart-transaksi" class="w-full h-72"></div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-base font-bold text-gray-900">Distribusi Kondisi Barang</h3>
                    </div>
                    @if(count($kondisiLabels) > 0)
                    <div id="chart-kondisi" class="w-full flex justify-center mt-4"></div>
                    @else
                    <div class="h-64 flex flex-col items-center justify-center text-gray-400">
                        <svg class="w-12 h-12 mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                            </path>
                        </svg>
                        <p class="text-sm">Data belum tersedia.</p>
                    </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {

        // Jurus Pamungkas: Pakai tag PHP murni agar kebal dari Prettier VS Code
        var bulanLabels = <?php echo json_encode($months); ?>;
        var dataPeminjaman = <?php echo json_encode($peminjamanData); ?>;
        var dataPermintaan = <?php echo json_encode($permintaanData); ?>;

        if (document.querySelector("#chart-transaksi")) {
            var optionsTransaksi = {
                series: [{
                    name: 'Peminjaman Alat',
                    data: dataPeminjaman
                }, {
                    name: 'Permintaan Bahan',
                    data: dataPermintaan
                }],
                chart: {
                    type: 'bar',
                    height: 300,
                    toolbar: {
                        show: false
                    },
                    fontFamily: 'Inter, sans-serif'
                },
                colors: ['#2563eb', '#6366f1'], // Blue & Indigo
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '45%',
                        borderRadius: 4,
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: bulanLabels,
                    labels: {
                        style: {
                            colors: '#64748b'
                        }
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: '#64748b'
                        }
                    },
                },
                grid: {
                    borderColor: '#f1f5f9',
                    strokeDashArray: 4,
                    yaxis: {
                        lines: {
                            show: true
                        }
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " Transaksi"
                        }
                    }
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right'
                }
            };

            var chartTransaksi = new ApexCharts(document.querySelector("#chart-transaksi"), optionsTransaksi);
            chartTransaksi.render();
        }

        // 2. RENDER DONUT CHART (KONDISI BARANG)
        <?php if(count($kondisiLabels) > 0): ?>
        var labelKondisi = <?php echo json_encode($kondisiLabels); ?>;
        var dataKondisi = <?php echo json_encode($kondisiData); ?>;

        if (document.querySelector("#chart-kondisi")) {
            var optionsKondisi = {
                series: dataKondisi,
                chart: {
                    type: 'donut',
                    height: 300,
                    fontFamily: 'Inter, sans-serif'
                },
                labels: labelKondisi,
                colors: ['#22c55e', '#ef4444', '#eab308', '#3b82f6', '#8b5cf6'],
                plotOptions: {
                    pie: {
                        donut: {
                            size: '75%',
                            labels: {
                                show: true,
                                name: {
                                    show: true,
                                    fontSize: '14px',
                                    color: '#64748b'
                                },
                                value: {
                                    show: true,
                                    fontSize: '24px',
                                    fontWeight: 'bold',
                                    color: '#0f172a',
                                    formatter: function(val) {
                                        return val + " Item"
                                    }
                                },
                                total: {
                                    show: true,
                                    showAlways: true,
                                    label: 'Total Jenis',
                                    color: '#64748b'
                                }
                            }
                        }
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 0
                },
                legend: {
                    position: 'bottom',
                    horizontalAlign: 'center',
                    markers: {
                        radius: 12
                    }
                }
            };

            var chartKondisi = new ApexCharts(document.querySelector("#chart-kondisi"), optionsKondisi);
            chartKondisi.render();
        }
        <?php endif; ?>

    });
    </script>
</x-app-layout>
