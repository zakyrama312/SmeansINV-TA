<?php

use Illuminate\Support\Facades\Auth; ?>
<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4 bg-gradient-to-r from-emerald-500 to-teal-600 text-white overflow-hidden relative">
                <div class="z-10">
                    <h2 class="text-2xl font-bold mb-1">Halo, {{ Auth::user()->name }}! 👋</h2>
                    <p class="text-teal-50 text-sm">Selamat datang di portal layanan sirkulasi Laboratorium {{ Auth::user()->prodi->nama_prodi ?? '' }}.</p>
                </div>
                <div class="z-10 flex gap-3">
                    <a href="{{ route('peminjaman.create') }}" class="bg-white/20 hover:bg-white/30 border border-white/30 backdrop-blur-sm text-white px-4 py-2 rounded-lg text-sm font-semibold transition-colors shadow-sm">
                        Ajukan Peminjaman
                    </a>
                </div>
                <svg class="absolute -right-6 -bottom-6 w-48 h-48 text-white/10" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4 border-l-4 border-l-blue-500">
                    <div class="w-12 h-12 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-500 mb-0.5">Pengajuan Peminjaman Pending</p>
                        <h3 class="text-xl font-bold text-gray-900">{{ $pinjamanPending }} <span class="text-xs font-medium text-gray-400">Menunggu ACC</span></h3>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center gap-4 border-l-4 border-l-indigo-500">
                    <div class="w-12 h-12 rounded-full bg-indigo-50 text-indigo-500 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-500 mb-0.5">Pengajuan Permintaan Pending</p>
                        <h3 class="text-xl font-bold text-gray-900">{{ $permintaanPending }} <span class="text-xs font-medium text-gray-400">Menunggu ACC</span></h3>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center gap-3 mb-6">
                    <div class="p-2 bg-yellow-100 rounded-lg text-yellow-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Alat Yang Sedang Kamu Pinjam</h3>
                        <p class="text-sm text-gray-500">Harap kembalikan alat di bawah ini sesuai dengan tanggal tenggat waktu.</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="py-4 px-4 font-semibold w-12 text-center">No</th>
                                <th class="py-4 px-4 font-semibold">Kode Transaksi</th>
                                <th class="py-4 px-4 font-semibold">Daftar Alat</th>
                                <th class="py-4 px-4 font-semibold">Tanggal Pinjam</th>
                                <th class="py-4 px-4 font-semibold">Batas Kembali</th>
                                <th class="py-4 px-4 font-semibold text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($pinjamanAktif as $item)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-4 px-4 text-center">{{ $loop->iteration }}</td>
                                <td class="py-4 px-4 font-bold text-gray-900">{{ $item->kode_transaksi }}</td>
                                <td class="py-4 px-4">
                                    <ul class="space-y-1 text-xs">
                                        @foreach($item->details as $detail)
                                        <li>• {{ $detail->barang->nama_barang ?? 'Alat Dihapus' }} <span class="text-gray-400 font-bold">({{ $detail->jumlah }}x)</span></li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="py-4 px-4">{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->translatedFormat('d M Y') }}</td>
                                <td class="py-4 px-4 font-bold text-red-600">{{ \Carbon\Carbon::parse($item->tanggal_kembali)->translatedFormat('d M Y') }}</td>
                                <td class="py-4 px-4 text-center">
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800">Sedang Digunakan</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-gray-500">
                                    <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p>Bagus! Kamu tidak memiliki tanggungan pinjaman alat saat ini.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center gap-3 mb-6">
                    <div class="p-2 bg-indigo-100 rounded-lg text-indigo-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-gray-900">Bahan Habis Pakai Kelas Ini</h3>
                        <p class="text-sm text-gray-500">Klik tombol "Lapor Habis" jika bahan tersebut sudah benar-benar habis digunakan.</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="text-xs text-gray-500 uppercase bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="py-4 px-4 font-semibold w-12 text-center">No</th>
                                <th class="py-4 px-4 font-semibold">Nama Siswa</th>
                                <th class="py-4 px-4 font-semibold">Bahan Dipakai</th>
                                <th class="py-4 px-4 font-semibold text-center">Jumlah</th>
                                <th class="py-4 px-4 font-semibold text-center">Aksi Pelaporan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($bahanAktif as $item)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-4 px-4 text-center">{{ $loop->iteration }}</td>
                                <td class="py-4 px-4 font-bold text-gray-900">{{ $item->permintaan->nama_peminta }}</td>
                                <td class="py-4 px-4 font-medium text-indigo-600">{{ $item->barang->nama_barang ?? 'Barang Dihapus' }}</td>
                                <td class="py-4 px-4 text-center font-bold">{{ $item->jumlah }}</td>
                                <td class="py-4 px-4 text-center">
                                    <form action="{{ route('permintaan.lapor_habis', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" onclick="return confirm('Yakin barang ini sudah habis digunakan oleh {{ $item->permintaan->nama_peminta }}?');" class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold px-4 py-2 rounded-lg shadow-sm transition-colors">
                                            Lapor Habis
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-12 text-center text-gray-500">
                                    <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <p>Semua bahan habis pakai untuk kelas ini sudah dilaporkan selesai.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>