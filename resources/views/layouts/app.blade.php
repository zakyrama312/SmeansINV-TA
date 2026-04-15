<?php

use Illuminate\Support\Facades\Auth;
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Inventaris Lab SMK') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-gray-900 bg-gray-50">

    <div x-data="{ sidebarOpen: {{ request()->routeIs('*.create') ? 'false' : 'true' }} }"
        class="flex h-screen overflow-hidden bg-gray-50">

        @include('layouts.sidebar')

        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

            <header
                class="bg-white border-b border-gray-200 shadow-sm h-16 flex items-center justify-between px-4 sm:px-6 shrink-0 z-10">

                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = !sidebarOpen"
                        class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-900 focus:outline-none transition-colors hidden md:block">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            x-show="!sidebarOpen">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-show="sidebarOpen"
                            style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h8m-8 6h16"></path>
                        </svg>
                    </button>
                    <button @click="sidebarOpen = !sidebarOpen"
                        class="p-2 rounded-lg text-gray-500 hover:bg-gray-100 hover:text-gray-900 focus:outline-none transition-colors md:hidden">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>

                <div class="flex items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="flex items-center gap-2 px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 hover:text-gray-900 focus:outline-none transition ease-in-out duration-150 shadow-sm">
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-100 text-blue-700 border border-blue-200 flex items-center justify-center font-bold">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span class="hidden sm:block font-semibold">{{ Auth::user()->name }}</span>
                                <svg class="fill-current h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="px-4 py-3 border-b border-gray-100 bg-gray-50/50">
                                <p class="text-sm font-bold text-gray-900">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-500 truncate mt-0.5">{{ Auth::user()->email }}</p>
                            </div>
                            <x-dropdown-link :href="route('profile.edit')"
                                class="py-2.5 hover:bg-blue-50 hover:text-blue-700">
                                {{ __('Profile & Password') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="text-red-600 hover:bg-red-50 py-2.5 border-t border-gray-100">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto overflow-x-hidden bg-gray-50 relative">
                {{ $slot }}
            </main>
        </div>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 10px;
        }

        .custom-scrollbar:hover::-webkit-scrollbar-thumb {
            background: #475569;
        }
    </style>
</body>

</html>