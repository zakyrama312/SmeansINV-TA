@php
use Illuminate\Support\Facades\Auth;
@endphp
<x-app-layout>
    <div x-data="{ openRejectModal: false, rejectUrl: '' }" class="py-8 bg-gray-50 min-h-screen relative">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Kelola Permintaan Barang</h2>
                    <p class="text-sm text-gray-500 mt-1">Sirkulasi pengeluaran bahan habis pakai laboratorium</p>
                </div>
                <a href="{{ route('permintaan.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 rounded-lg font-semibold text-sm text-white hover:bg-indigo-700 transition shadow-sm">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Permintaan
                </a>
            </div>

            @if(session('success'))
            <div
                class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg shadow-sm font-medium">
                {{ session('success') }}
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div
                    class="bg-yellow-500 rounded-xl p-5 text-white shadow-sm relative overflow-hidden flex justify-between items-center">
                    <div class="z-10">
                        <p class="text-sm font-medium text-yellow-100 mb-1">Pending</p>
                        <h3 class="text-3xl font-bold">{{ $statPending }}</h3>
                    </div>
                    <div class="bg-yellow-400/50 p-3 rounded-lg z-10">
                        <svg class="w-6 h-6 text-yellow-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>

                <div
                    class="bg-emerald-500 rounded-xl p-5 text-white shadow-sm relative overflow-hidden flex justify-between items-center">
                    <div class="z-10">
                        <p class="text-sm font-medium text-emerald-100 mb-1">Disetujui (Selesai)</p>
                        <h3 class="text-3xl font-bold">{{ $statDisetujui }}</h3>
                    </div>
                    <div class="bg-emerald-400/50 p-3 rounded-lg z-10">
                        <svg class="w-6 h-6 text-emerald-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>

                <div
                    class="bg-red-500 rounded-xl p-5 text-white shadow-sm relative overflow-hidden flex justify-between items-center">
                    <div class="z-10">
                        <p class="text-sm font-medium text-red-100 mb-1">Ditolak</p>
                        <h3 class="text-3xl font-bold">{{ $statDitolak }}</h3>
                    </div>
                    <div class="bg-red-400/50 p-3 rounded-lg z-10">
                        <svg class="w-6 h-6 text-red-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">

                <form method="GET" action="{{ route('permintaan.index') }}"
                    class="flex flex-col md:flex-row gap-4 justify-between items-center mb-6">
                    <div class="relative w-full md:w-80">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" id="searchInput"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 block w-full pl-10 p-2.5"
                            placeholder="Cari peminta atau barang...">
                    </div>

                    <div class="flex flex-col md:flex-row items-center gap-2 w-full md:w-auto">
                        <select name="status"
                            class="bg-white border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-indigo-500 block py-2.5 w-full md:w-36">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending
                            </option>
                            <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui
                            </option>
                            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak
                            </option>
                        </select>
                        <div class="flex items-center gap-2 w-full">
                            <input type="date" name="start_date" value="{{ request('start_date') }}"
                                class="bg-white border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-indigo-500 block p-2.5 w-full">
                            <span class="text-gray-500">—</span>
                            <input type="date" name="end_date" value="{{ request('end_date') }}"
                                class="bg-white border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-indigo-500 block p-2.5 w-full">
                        </div>
                        <div class="flex gap-2">
                            <button type="submit"
                                class="bg-gray-800 hover:bg-gray-900 text-white font-semibold text-sm px-4 py-2.5 rounded-lg shadow-sm transition-colors">
                                Filter
                            </button>
                            @if(request()->has('status') || request()->has('start_date'))
                            <a href="{{ route('permintaan.index') }}"
                                class="bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 font-semibold text-sm px-4 py-2.5 rounded-lg shadow-sm transition-colors">
                                Reset
                            </a>
                            @endif
                        </div>
                    </div>
                </form>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="py-4 px-4 font-semibold text-center w-12">No</th>
                                <th class="py-4 px-4 font-semibold">Peminta</th>
                                <th class="py-4 px-4 font-semibold">Bahan Diminta</th>
                                <th class="py-4 px-4 font-semibold text-center">Jumlah</th>
                                <th class="py-4 px-4 font-semibold">Tanggal</th>
                                <th class="py-4 px-4 font-semibold text-center">Status</th>
                                <th class="py-4 px-4 font-semibold w-48">Keterangan</th>
                                @if (Auth::user()->role === 'teknisi')

                                <th class="py-4 px-4 font-semibold text-center">Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($permintaans as $item)
                            <tr class="hover:bg-gray-50/50 transition-colors row-transaksi">
                                <td class="py-4 px-4 text-center font-medium">{{ $loop->iteration }}</td>

                                <td class="py-4 px-4">
                                    <div class="font-bold text-gray-900 data-peminjam">{{ $item->nama_peminta }}</div>
                                    <div class="text-xs text-gray-500">{{ $item->kelas }}</div>
                                </td>

                                <td class="py-4 px-4">
                                    @if($item->details->count() > 0)
                                    @php $firstBarang = $item->details->first()->barang; @endphp
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-lg overflow-hidden flex-shrink-0 bg-indigo-50 border border-gray-100 flex items-center justify-center">
                                            @if($firstBarang && $firstBarang->foto)
                                            <img src="{{ asset('storage/' . $firstBarang->foto) }}"
                                                class="w-full h-full object-cover">
                                            @else
                                            <div
                                                class="bg-indigo-500 p-2 rounded w-8 h-8 flex items-center justify-center">
                                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4">
                                                    </path>
                                                </svg>
                                            </div>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="font-bold text-gray-900 data-barang">
                                                {{ $firstBarang->nama_barang ?? 'Barang Dihapus' }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                {{ $firstBarang->kategori->nama_kategori ?? '-' }}
                                                @if($item->details->count() > 1)
                                                <span
                                                    class="text-indigo-500 font-semibold">(+{{ $item->details->count() - 1 }}
                                                    lainnya)</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </td>

                                <td class="py-4 px-4 text-center font-bold text-gray-900">
                                    {{ $item->details->sum('jumlah') }}
                                </td>

                                <td class="py-4 px-4 text-xs font-medium">
                                    <div class="text-gray-900"><span class="text-gray-500">Diajukan:</span>
                                        {{ \Carbon\Carbon::parse($item->tanggal_permintaan)->format('d M Y') }}
                                    </div>
                                </td>

                                <td class="py-4 px-4 text-center">
                                    @if($item->status == 'pending')
                                    <span
                                        class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-700">Pending</span>
                                    @elseif($item->status == 'disetujui')
                                    <span
                                        class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Disetujui</span>
                                    @elseif($item->status == 'ditolak')
                                    <span
                                        class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">Ditolak</span>
                                    @endif
                                </td>

                                <td class="py-4 px-4 text-xs text-gray-600 max-w-xs">
                                    <div class="line-clamp-2" title="{{ $item->keterangan }}">
                                        {{ $item->keterangan ?? '-' }}
                                    </div>
                                </td>
                                @if (Auth::user()->role === 'teknisi')
                                <td class="py-4 px-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        @if($item->status == 'pending')
                                        <form action="{{ route('permintaan.approve', $item->id) }}" method="POST"
                                            class="inline">
                                            @csrf @method('PATCH')
                                            <button type="submit"
                                                onclick="return confirm('Setujui permintaan dan kurangi stok permanen?');"
                                                class="inline-flex items-center px-3 py-1.5 bg-green-500 hover:bg-green-600 text-white text-xs font-bold rounded-md transition-colors">
                                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Setuju
                                            </button>
                                        </form>

                                        <button
                                            @click="openRejectModal = true; rejectUrl = '{{ route('permintaan.reject', $item->id) }}'"
                                            class="inline-flex items-center px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-xs font-bold rounded-md transition-colors">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            Tolak
                                        </button>

                                        @elseif($item->status == 'disetujui')
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 bg-green-50 text-green-600 border border-green-200 rounded-md text-xs font-bold">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Selesai
                                        </span>

                                        @elseif($item->status == 'ditolak')
                                        <span
                                            class="inline-flex items-center px-2.5 py-1 bg-red-50 text-red-600 border border-red-200 rounded-md text-xs font-bold">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            Ditolak
                                        </span>
                                        @endif
                                    </div>
                                </td>
                                @endif

                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="py-12 text-center text-gray-500">Belum ada riwayat permintaan
                                    barang.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div x-show="openRejectModal" style="display: none;" class="relative z-50" aria-labelledby="modal-title"
            role="dialog" aria-modal="true">
            <div x-show="openRejectModal" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity">
            </div>

            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div x-show="openRejectModal" x-transition:enter="ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave="ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                        <form :action="rejectUrl" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div
                                        class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                    </div>
                                    <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
                                        <h3 class="text-lg font-bold leading-6 text-gray-900" id="modal-title">Tolak
                                            Permintaan</h3>
                                        <div class="mt-2">
                                            <p class="text-sm text-gray-500 mb-3">Silakan tulis alasan kenapa permintaan
                                                ini ditolak. Alasan ini akan tersimpan di kolom keterangan.</p>
                                            <textarea name="alasan_penolakan" rows="3" required
                                                class="block w-full rounded-lg border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-red-500 focus:ring-red-500"
                                                placeholder="Contoh: Stok sedang habis / Permintaan ditunda..."></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                <button type="submit"
                                    class="inline-flex w-full justify-center rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto transition-colors">Tolak
                                    Transaksi</button>
                                <button type="button" @click="openRejectModal = false"
                                    class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-4 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto transition-colors">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const rows = document.querySelectorAll('.row-transaksi');

            searchInput.addEventListener('keyup', function(e) {
                const term = e.target.value.toLowerCase();
                rows.forEach(row => {
                    const nama = row.querySelector('.data-peminjam').textContent.toLowerCase();
                    const barang = row.querySelector('.data-barang') ? row.querySelector(
                        '.data-barang').textContent.toLowerCase() : '';
                    row.style.display = (nama.includes(term) || barang.includes(term)) ? '' :
                        'none';
                });
            });
        });
    </script>
</x-app-layout>