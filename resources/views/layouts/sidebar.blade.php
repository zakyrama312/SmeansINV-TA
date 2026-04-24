<?php

use Illuminate\Support\Str;
?>

<div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" @click="if(window.innerWidth < 768) sidebarOpen = false"
    class="fixed inset-0 bg-slate-900/80 z-50 md:hidden backdrop-blur-sm" style="display: none;">
</div>

<aside x-init="if(window.innerWidth < 768) sidebarOpen = false"
    class="flex flex-col bg-slate-900 text-white transition-all duration-300 ease-in-out shadow-[4px_0_24px_rgba(0,0,0,0.5)] z-[60] shrink-0 h-full absolute md:relative"
    :class="sidebarOpen ? 'translate-x-0 w-64' : '-translate-x-full md:translate-x-0 w-64 md:w-20'">

    <div class="flex items-center justify-between h-16 px-4 bg-slate-950/50 border-b border-slate-800 shrink-0">
        <div class="flex items-center gap-3 overflow-hidden whitespace-nowrap">
            <div class="bg-blue-600 p-1.5 rounded-lg shrink-0">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                    </path>
                </svg>
            </div>
            <span x-show="sidebarOpen" x-transition.duration.300ms
                class="font-bold text-lg tracking-wide text-white">LabFlow</span>
        </div>

        <button @click="sidebarOpen = false"
            class="md:hidden text-slate-400 hover:text-white p-1.5 rounded-lg hover:bg-slate-800 focus:outline-none transition-colors"
            x-show="sidebarOpen">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1.5 custom-scrollbar pb-24 md:pb-4">

        <p x-show="sidebarOpen" class="px-3 text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2 mt-2">
            Utama</p>

        <a href="{{ route('dashboard') }}"
            class="flex items-center px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
            title="Dashboard">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                </path>
            </svg>
            <span x-show="sidebarOpen" class="ml-3 font-medium whitespace-nowrap">Dashboard</span>
        </a>

        <p x-show="sidebarOpen" class="px-3 text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2 mt-6">
            Transaksi Sirkulasi</p>

        <a href="{{ route('peminjaman.index') }}"
            class="flex items-center px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('peminjaman.*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
            title="Peminjaman Alat">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
            </svg>
            <span x-show="sidebarOpen" class="ml-3 font-medium whitespace-nowrap">Peminjaman <span
                    class="text-[10px] text-blue-200 ml-1 font-normal">(Alat)</span></span>
        </a>

        <a href="{{ route('permintaan.index') }}"
            class="flex items-center px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('permintaan.*') ? 'bg-indigo-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
            title="Permintaan Bahan">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
            </svg>
            <span x-show="sidebarOpen" class="ml-3 font-medium whitespace-nowrap">Permintaan <span
                    class="text-[10px] text-indigo-200 ml-1 font-normal">(Bahan)</span></span>
        </a>


        @if(auth()->user()->role === 'teknisi')
        <p x-show="sidebarOpen" class="px-3 text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2 mt-6">
            Sistem & Master Data</p>

        <a href="{{ route('barang.index') }}"
            class="flex items-center px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('barang.*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
            title="Data Barang">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                </path>
            </svg>
            <span x-show="sidebarOpen" class="ml-3 font-medium whitespace-nowrap">Data Barang</span>
        </a>

        <div
            x-data="{ masterOpen: {{ request()->routeIs('prodi.*', 'ruang.*', 'kategori.*', 'kondisi.*') ? 'true' : 'false' }} }">
            <button @click="masterOpen = !masterOpen"
                class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('prodi.*', 'ruang.*', 'kategori.*', 'kondisi.*') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                title="Master Data">
                <div class="flex items-center">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4">
                        </path>
                    </svg>
                    <span x-show="sidebarOpen" class="ml-3 font-medium whitespace-nowrap">Master Data</span>
                </div>
                <svg x-show="sidebarOpen" :class="{'rotate-180': masterOpen}"
                    class="w-4 h-4 transition-transform duration-200 text-slate-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <div x-show="masterOpen && sidebarOpen" x-transition.opacity class="pl-11 pr-3 py-2 space-y-1">
                <a href="{{ route('prodi.index') }}"
                    class="block px-3 py-2 rounded-lg text-sm transition-colors {{ request()->routeIs('prodi.*') ? 'bg-blue-600/20 text-blue-400 font-semibold' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">Prodi</a>
                <a href="{{ route('ruang.index') }}"
                    class="block px-3 py-2 rounded-lg text-sm transition-colors {{ request()->routeIs('ruang.*') ? 'bg-blue-600/20 text-blue-400 font-semibold' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">Ruang
                    Lab</a>
                <a href="{{ route('kategori.index') }}"
                    class="block px-3 py-2 rounded-lg text-sm transition-colors {{ request()->routeIs('kategori.*') ? 'bg-blue-600/20 text-blue-400 font-semibold' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">Kategori</a>
                <a href="{{ route('kondisi.index') }}"
                    class="block px-3 py-2 rounded-lg text-sm transition-colors {{ request()->routeIs('kondisi.*') ? 'bg-blue-600/20 text-blue-400 font-semibold' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">Kondisi</a>
            </div>
        </div>

        <a href="{{ route('users.index') }}"
            class="flex items-center px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('users.*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
            title="Data Pengguna">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                </path>
            </svg>
            <span x-show="sidebarOpen" class="ml-3 font-medium whitespace-nowrap">Data Pengguna</span>
        </a>
        @endif


        @if(in_array(auth()->user()->role, ['teknisi', 'kaprodi']))
        <p x-show="sidebarOpen" class="px-3 text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2 mt-6">
            Laporan</p>

        <div x-data="{ laporanOpen: {{ request()->routeIs('laporan.ruang') ? 'true' : 'false' }} }">
            <button @click="laporanOpen = !laporanOpen"
                class="w-full flex items-center justify-between px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('laporan.ruang') ? 'bg-slate-800 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                title="Data Ruang">
                <div class="flex items-center">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <span x-show="sidebarOpen" class="ml-3 font-medium whitespace-nowrap">Data Ruang</span>
                </div>
                <svg x-show="sidebarOpen" :class="{'rotate-180': laporanOpen}"
                    class="w-4 h-4 transition-transform duration-200 text-slate-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <div x-show="laporanOpen && sidebarOpen" x-transition.opacity class="pl-11 pr-3 py-2 space-y-1">
                @if(isset($sidebarRuangs) && $sidebarRuangs->count() > 0)
                @foreach($sidebarRuangs as $ruang)
                @php $slugRuang = Str::slug($ruang->nama_ruang); @endphp
                <a href="{{ route('laporan.ruang', $slugRuang) }}"
                    class="block px-3 py-2 rounded-lg text-sm transition-colors {{ request()->url() == route('laporan.ruang', $slugRuang) ? 'bg-blue-600/20 text-blue-400 font-semibold' : 'text-slate-400 hover:text-white hover:bg-slate-800' }}">
                    {{ $ruang->nama_ruang }}
                </a>
                @endforeach
                @else
                <span class="block px-3 py-2 text-xs text-slate-500 italic">Belum ada ruang</span>
                @endif
            </div>
        </div>

        <a href="{{ route('laporan.peminjaman') }}"
            class="flex items-center px-3 py-2.5 rounded-xl transition-colors mt-1 {{ request()->routeIs('laporan.peminjaman') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
            title="Laporan Peminjaman">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                </path>
            </svg>
            <span x-show="sidebarOpen" class="ml-3 font-medium whitespace-nowrap">Laporan Peminjaman</span>
        </a>

        <a href="{{ route('laporan.permintaan') }}"
            class="flex items-center px-3 py-2.5 rounded-xl transition-colors mt-1 {{ request()->routeIs('laporan.permintaan') ? 'bg-indigo-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
            title="Laporan Permintaan">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                </path>
            </svg>
            <span x-show="sidebarOpen" class="ml-3 font-medium whitespace-nowrap">Laporan Permintaan</span>
        </a>
        <a href="{{ route('laporan.pemakaian') }}"
            class="flex items-center px-3 py-2.5 rounded-xl transition-colors mt-1 {{ request()->routeIs('laporan.pemakaian') ? 'bg-green-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
            title="Laporan Pemakaian">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                </path>
            </svg>
            <span x-show="sidebarOpen" class="ml-3 font-medium whitespace-nowrap">Laporan Pemakaian</span>
        </a>

        @endif

    </nav>
</aside>