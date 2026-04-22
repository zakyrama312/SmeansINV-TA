<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">

                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Laporan Pemakaian Bahan</h2>
                        <p class="text-sm text-gray-500 mt-1">Rekapitulasi pengeluaran bahan habis pakai di lab Anda.
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('laporan.pemakaian.cetak', request()->all()) }}" target="_blank"
                            class="inline-flex items-center px-4 py-2.5 bg-[#ef4444] hover:bg-red-600 text-white text-sm font-bold rounded-lg transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                                </path>
                            </svg>
                            Export PDF / Cetak
                        </a>
                        <a href="{{ route('laporan.pemakaian.excel', request()->all()) }}"
                            class="inline-flex items-center px-4 py-2.5 bg-[#10b981] hover:bg-emerald-600 text-white text-sm font-bold rounded-lg transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Export Excel
                        </a>
                    </div>
                </div>

                <div class="bg-gray-50/50 border border-gray-200 rounded-xl p-5 mb-8">
                    <form action="{{ route('laporan.pemakaian') }}" method="GET"
                        class="flex flex-col lg:flex-row gap-4 items-end">
                        <div class="w-full lg:w-auto">
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Dari
                                Tanggal</label>
                            <input type="date" name="start_date" value="{{ request('start_date') }}"
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-slate-500 focus:border-slate-500 block w-full p-2.5">
                        </div>
                        <div class="w-full lg:w-auto">
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Sampai
                                Tanggal</label>
                            <input type="date" name="end_date" value="{{ request('end_date') }}"
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-slate-500 focus:border-slate-500 block w-full p-2.5">
                        </div>
                        <!-- <div class="w-full lg:flex-grow">
                            <label
                                class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Status</label>
                            <select name="status"
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-slate-500 focus:border-slate-500 block w-full p-2.5 outline-none pointer-events-none text-gray-500">
                                <option value="habis" selected>Semua Status (Habis Dipakai)</option>
                            </select>
                        </div> -->
                        <div class="w-full lg:w-auto mt-4 lg:mt-0">
                            <button type="submit"
                                class="w-full px-6 py-2.5 bg-[#1e293b] hover:bg-slate-900 text-white font-bold text-sm rounded-lg transition-colors shadow-sm">
                                Terapkan Filter
                            </button>
                        </div>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead
                            class="text-[11px] text-gray-500 uppercase font-bold border-b border-gray-200 tracking-wider">
                            <tr>
                                <th class="py-4 px-4 w-12 text-center">NO</th>
                                <th class="py-4 px-4">PEMINTA</th>
                                <th class="py-4 px-4">BARANG DIMINTA (TOTAL)</th>
                                <th class="py-4 px-4">TANGGAL DIAJUKAN</th>
                                <th class="py-4 px-4 text-center">STATUS</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($laporan as $item)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="py-4 px-4 text-center font-medium">{{ $loop->iteration }}</td>
                                <td class="py-4 px-4">
                                    <div class="font-extrabold text-gray-900 text-base">
                                        {{ $item->permintaan->nama_peminta }}
                                    </div>
                                    <div class="text-xs text-gray-500 mt-0.5">{{ $item->permintaan->kelas ?? '-' }}
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <ul class="list-disc list-inside text-gray-600">
                                        <li><span
                                                class="font-medium text-gray-800">{{ $item->barang->nama_barang ?? 'Barang Terhapus' }}</span>
                                            ({{ $item->jumlah }}x)</li>
                                    </ul>
                                </td>
                                <td class="py-4 px-4 whitespace-nowrap">
                                    <div class="text-gray-600 font-medium">{{ $item->updated_at->format('d M Y') }}
                                    </div>
                                </td>
                                <td class="py-4 px-4 text-center">
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold bg-[#d1fae5] text-[#059669]">
                                        Habis
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="w-10 h-10 text-gray-300 mb-3" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                        <p class="font-medium text-gray-600">Data laporan kosong</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-6 pt-4 border-t border-gray-100">
                    {{ $laporan->links() }}
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            body {
                background-color: white !important;
            }

            .bg-gray-50 {
                background-color: white !important;
            }

            /* Menyembunyikan sidebar, navbar, tombol print/excel, dan kotak filter */
            header,
            nav,
            form,
            button,
            .bg-gray-50\/50 {
                display: none !important;
            }

            .shadow-sm {
                box-shadow: none !important;
            }

            .border-gray-100 {
                border-color: #e5e7eb !important;
                border-width: 1px !important;
            }

            /* Mengatasi sidebar agar konten memanjang penuh */
            div[x-data]>div:first-child {
                display: none !important;
            }
        }
    </style>
</x-app-layout>