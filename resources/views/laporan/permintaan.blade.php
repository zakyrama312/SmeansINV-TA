<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">

                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Laporan Permintaan Barang</h2>
                        <p class="text-sm text-gray-500 mt-1">Rekapitulasi pengeluaran bahan habis pakai</p>
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ route('laporan.permintaan.cetak', request()->query()) }}" target="_blank"
                            class="inline-flex items-center px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white text-sm font-bold rounded-xl shadow-sm shadow-red-500/30 transition-all transform hover:-translate-y-0.5">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z">
                                </path>
                            </svg>
                            Export PDF / Cetak
                        </a>
                        <a href="{{ route('laporan.permintaan.excel', request()->query()) }}"
                            class="inline-flex items-center px-4 py-2.5 bg-green-600 hover:bg-green-700 text-white text-sm font-bold rounded-xl shadow-sm shadow-green-600/30 transition-all transform hover:-translate-y-0.5">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z">
                                </path>
                            </svg>
                            Export Excel
                        </a>
                    </div>
                </div>

                <form method="GET" action="{{ route('laporan.permintaan') }}"
                    class="bg-slate-50 p-5 rounded-xl border border-slate-200 mb-8 flex flex-col md:flex-row gap-4 items-end">
                    <div class="w-full md:w-auto">
                        <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wide">Dari
                            Tanggal</label>
                        <input type="date" name="start_date" value="{{ request('start_date') }}"
                            class="bg-white border border-slate-300 text-sm rounded-lg focus:ring-indigo-500 block w-full p-2.5">
                    </div>
                    <div class="w-full md:w-auto">
                        <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wide">Sampai
                            Tanggal</label>
                        <input type="date" name="end_date" value="{{ request('end_date') }}"
                            class="bg-white border border-slate-300 text-sm rounded-lg focus:ring-indigo-500 block w-full p-2.5">
                    </div>
                    <div class="w-full md:w-auto">
                        <label
                            class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wide">Status</label>
                        <select name="status"
                            class="bg-white border border-slate-300 text-sm rounded-lg focus:ring-indigo-500 block w-full p-2.5 md:w-40">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending
                            </option>
                            <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui
                            </option>
                            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak
                            </option>
                        </select>
                    </div>
                    <div class="flex gap-2 w-full md:w-auto mt-2 md:mt-0">
                        <button type="submit"
                            class="bg-slate-800 hover:bg-slate-900 text-white px-5 py-2.5 rounded-lg text-sm font-bold shadow-sm transition-colors w-full md:w-auto">Terapkan
                            Filter</button>
                        @if(request()->has('start_date') || request()->has('status'))
                        <a href="{{ route('laporan.permintaan') }}"
                            class="bg-white hover:bg-red-50 text-red-600 border border-slate-300 px-5 py-2.5 rounded-lg text-sm font-bold transition-colors w-full md:w-auto text-center">Reset</a>
                        @endif
                    </div>
                </form>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="py-4 px-4 text-center w-12 font-semibold">No</th>
                                <th class="py-4 px-4 font-semibold">Peminta</th>
                                <th class="py-4 px-4 font-semibold">Barang Diminta (Total)</th>
                                <th class="py-4 px-4 font-semibold">Tanggal Diajukan</th>
                                <th class="py-4 px-4 text-center font-semibold">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($permintaans as $index => $item)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="py-4 px-4 text-center font-medium">{{ $permintaans->firstItem() + $index }}
                                </td>
                                <td class="py-4 px-4">
                                    <div class="font-bold text-gray-900">{{ $item->nama_peminta }}</div>
                                    <div class="text-xs text-gray-500 mt-0.5">{{ $item->kelas }}</div>
                                </td>
                                <td class="py-4 px-4 text-xs font-medium text-gray-700">
                                    <ul class="space-y-1">
                                        @foreach($item->details as $detail)
                                        <li class="flex items-center">
                                            <span class="w-1.5 h-1.5 rounded-full bg-gray-400 mr-2"></span>
                                            {{ $detail->barang->nama_barang ?? 'Dihapus' }} <span
                                                class="ml-1 text-gray-500">({{ $detail->jumlah }}x)</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="py-4 px-4 text-xs font-medium">
                                    {{ \Carbon\Carbon::parse($item->tanggal_permintaan)->format('d M Y') }}
                                </td>
                                <td class="py-4 px-4 text-center">
                                    @if($item->status == 'pending')
                                    <span
                                        class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800">Pending</span>
                                    @elseif($item->status == 'disetujui')
                                    <span
                                        class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800">Disetujui</span>
                                    @elseif($item->status == 'ditolak')
                                    <span
                                        class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800">Ditolak</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-12 text-gray-500">Tidak ada data permintaan yang
                                    sesuai.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">{{ $permintaans->appends(request()->query())->links() }}</div>

            </div>
        </div>
    </div>
</x-app-layout>