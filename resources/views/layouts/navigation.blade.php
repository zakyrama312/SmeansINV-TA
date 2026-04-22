<?php

use Illuminate\Support\Facades\Auth; ?>

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 relative z-[9999]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    <div class="hidden sm:flex sm:items-center sm:ms-6">
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('kategori.*', 'kondisi.*', 'ruang.*', 'prodi.*') ? 'border-blue-500 text-gray-900 focus:border-blue-700' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:text-gray-700 focus:border-gray-300' }} text-sm font-medium leading-5 transition duration-150 ease-in-out focus:outline-none h-16 cursor-pointer gap-1">
                                    <div>Master Data</div>
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('prodi.index')" :active="request()->routeIs('prodi.*')">
                                    {{ __('Prodi') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('ruang.index')" :active="request()->routeIs('ruang.*')">
                                    {{ __('Ruang') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('kategori.index')"
                                    :active="request()->routeIs('kategori.*')">
                                    {{ __('Kategori') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('kondisi.index')"
                                    :active="request()->routeIs('kondisi.*')">
                                    {{ __('Kondisi') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    </div>
                    <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.*')">
                        {{ __('Data Pengguna') }}
                    </x-nav-link>
                    <x-nav-link :href="route('barang.index')" :active="request()->routeIs('barang.*')">
                        {{ __('Data Barang') }}
                    </x-nav-link>
                    <x-nav-link :href="route('peminjaman.index')" :active="request()->routeIs('peminjaman.index')">
                        {{ __('Peminjaman') }}
                    </x-nav-link>
                    <x-nav-link :href="route('permintaan.index')" :active="request()->routeIs('permintaan.index')">
                        {{ __('Permintaan') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="flex items-center gap-3">

                @if(Auth::check() && in_array(strtolower(Auth::user()->role), ['teknisi', 'kaprodi']))
                <div class="relative flex items-center" x-data="{ openNotif: false }">
                    <button @click="openNotif = !openNotif"
                        class="relative p-2 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-full transition-colors focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                            </path>
                        </svg>

                        @if(isset($totalPending) && $totalPending > 0)
                        <span
                            class="absolute top-1.5 right-1.5 flex items-center justify-center w-4 h-4 text-[9px] font-bold text-white bg-red-500 border-2 border-white rounded-full">
                            {{ $totalPending > 99 ? '99+' : $totalPending }}
                        </span>
                        @endif
                    </button>

                    <div x-show="openNotif" @click.away="openNotif = false" style="display: none;"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                        class="absolute right-0 top-full mt-3 w-80 bg-white rounded-xl shadow-[0_20px_50px_-12px_rgba(0,0,0,0.3)] border border-gray-100 z-[9999] overflow-hidden">

                        <div class="px-4 py-3 border-b border-gray-50 flex justify-between items-center bg-gray-50/50">
                            <h3 class="text-sm font-bold text-gray-900">Menunggu Persetujuan</h3>
                            <span
                                class="text-xs font-bold text-blue-700 bg-blue-100 px-2 py-0.5 rounded-md">{{ $totalPending ?? 0 }}
                                Baru</span>
                        </div>

                        <div class="max-h-80 overflow-y-auto custom-scrollbar">
                            @if(isset($totalPending) && $totalPending > 0)
                            @if(isset($notifPeminjaman) && count($notifPeminjaman) > 0)
                            @foreach($notifPeminjaman as $notif)
                            <a href="{{ route('peminjaman.index') }}"
                                class="block px-4 py-3 hover:bg-blue-50 transition-colors border-b border-gray-50 border-l-4 border-l-blue-500">
                                <p class="text-sm text-gray-800"><span
                                        class="font-bold text-gray-900">{{ $notif->nama_peminjam }}</span> mengajukan
                                    pinjaman alat.</p>
                                <p class="text-[11px] text-gray-400 mt-1 font-medium">
                                    {{ $notif->created_at->diffForHumans() }}
                                </p>
                            </a>
                            @endforeach
                            @endif

                            @if(isset($notifPermintaan) && count($notifPermintaan) > 0)
                            @foreach($notifPermintaan as $notif)
                            <a href="{{ route('permintaan.index') }}"
                                class="block px-4 py-3 hover:bg-indigo-50 transition-colors border-b border-gray-50 border-l-4 border-l-indigo-500">
                                <p class="text-sm text-gray-800"><span
                                        class="font-bold text-gray-900">{{ $notif->nama_peminta }}</span> meminta bahan.
                                </p>
                                <p class="text-[11px] text-gray-400 mt-1 font-medium">
                                    {{ $notif->created_at->diffForHumans() }}
                                </p>
                            </a>
                            @endforeach
                            @endif
                            @else
                            <div class="px-4 py-8 text-center text-gray-500">
                                <div
                                    class="bg-gray-50 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <p class="text-sm font-medium text-gray-600">Semua pengajuan sudah beres!</p>
                                <p class="text-xs text-gray-400 mt-1">Tidak ada tugas ACC saat ini.</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
                <div class="hidden sm:flex sm:items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-xs mr-2">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-sm text-gray-900 font-bold leading-none">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500 font-medium mt-1 truncate">{{ Auth::user()->email }}</p>
                            </div>

                            <x-dropdown-link :href="route('profile.edit')" class="mt-1">
                                {{ __('Profile & Password') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="text-red-600 hover:text-red-700 hover:bg-red-50">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}"
        class="hidden sm:hidden bg-white border-t border-gray-200 absolute w-full z-[9999]">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();" class="text-red-600">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>