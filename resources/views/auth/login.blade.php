<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - LabFlow</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    </style>
</head>

<body class="bg-gray-50 text-gray-900 antialiased selection:bg-blue-500 selection:text-white">
    <div class="min-h-screen flex">

        <div
            class="hidden lg:flex lg:w-1/2 bg-slate-900 relative overflow-hidden flex-col justify-between p-12 lg:p-16">
            <div class="absolute inset-0 z-0 opacity-10 pointer-events-none">
                <svg class="absolute w-full h-full" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="grid-pattern" width="40" height="40" patternUnits="userSpaceOnUse">
                            <path d="M0 40V0H40" fill="none" stroke="white" stroke-width="1" />
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#grid-pattern)" />
                </svg>
                <div
                    class="absolute top-0 right-0 -mr-32 -mt-32 w-96 h-96 rounded-full bg-blue-600 blur-[120px] opacity-50">
                </div>
                <div
                    class="absolute bottom-0 left-0 -ml-32 -mb-32 w-96 h-96 rounded-full bg-indigo-600 blur-[120px] opacity-50">
                </div>
            </div>

            <div class="relative z-10 flex items-center gap-3">
                <div
                    class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center shadow-[0_0_20px_rgba(37,99,235,0.4)]">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                        </path>
                    </svg>
                </div>
                <span class="text-white font-extrabold text-2xl tracking-wide">Lab<span
                        class="text-blue-400">Flow</span></span>
            </div>

            <div class="relative z-10 mt-10">
                <!-- <div
                    class="inline-block px-4 py-1.5 rounded-full border border-slate-700 bg-slate-800/50 text-blue-400 text-sm font-bold tracking-wide mb-6 backdrop-blur-md">
                    🚀 Versi 1.0 Enterprise
                </div> -->
                <h1 class="text-4xl lg:text-5xl font-extrabold text-white leading-[1.15] mb-6">
                    Manajemen Aset <br> Lebih <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-400">Cerdas</span>
                    & <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400">Efisien</span>.
                </h1>
                <p class="text-slate-400 text-lg max-w-md leading-relaxed font-medium">
                    Terintegrasi untuk sirkulasi peminjaman alat dan bahan laboratorium SMK Negeri 1 Slawi.
                </p>
            </div>

            <div class="relative z-10 text-slate-500 text-sm font-medium flex items-center gap-2">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                        clip-rule="evenodd"></path>
                </svg>
                SMK Negeri 1 Slawi
            </div>
        </div>

        <div
            class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12 lg:p-24 bg-white z-10 relative lg:rounded-l-[2.5rem] lg:-ml-6 shadow-[-20px_0_40px_-15px_rgba(0,0,0,0.1)]">
            <div class="w-full max-w-md">

                <div class="flex lg:hidden items-center gap-3 mb-10">
                    <div
                        class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/30">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>
                    </div>
                    <span class="text-slate-900 font-extrabold text-2xl tracking-wide">Lab<span
                            class="text-blue-600">Flow</span></span>
                </div>

                <div class="mb-10">
                    <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Selamat Datang 👋</h2>
                    <p class="text-gray-500 font-medium">Silakan masuk ke akun Anda untuk melanjutkan.</p>
                </div>

                @if ($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl shadow-sm">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-800 font-bold">Autentikasi Gagal!</p>
                            <p class="text-xs text-red-600 mt-0.5">Periksa kembali email dan password yang Anda
                                masukkan.</p>
                        </div>
                    </div>
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Alamat Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                    </path>
                                </svg>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all shadow-sm outline-none"
                                placeholder="contoh@smkn1slawi.sch.id">
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block text-sm font-bold text-gray-700">Password</label>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                    </path>
                                </svg>
                            </div>
                            <input id="password" type="password" name="password" required
                                class="block w-full pl-11 pr-12 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 font-medium focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all shadow-sm outline-none"
                                placeholder="••••••••">

                            <button type="button" id="togglePassword"
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-blue-600 focus:outline-none transition-colors">
                                <svg id="eyeOpen" class="h-5 w-5 hidden" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                    </path>
                                </svg>
                                <svg id="eyeClosed" class="h-5 w-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <label class="flex items-center cursor-pointer group">
                            <div class="relative flex items-center justify-center">
                                <input type="checkbox" name="remember"
                                    class="peer appearance-none w-5 h-5 border-2 border-gray-300 rounded-md bg-white checked:bg-blue-600 checked:border-transparent focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1 transition-all">
                                <svg class="absolute w-3.5 h-3.5 text-white opacity-0 peer-checked:opacity-100 pointer-events-none"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span
                                class="ml-2 text-sm font-bold text-gray-600 group-hover:text-gray-900 transition-colors">Ingat
                                Saya</span>
                        </label>
                    </div>

                    <button type="submit"
                        class="w-full flex justify-center items-center py-4 px-4 mt-4 border border-transparent rounded-xl shadow-lg shadow-blue-500/30 text-sm font-extrabold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:-translate-y-1">
                        Masuk ke Sistem
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </button>

                </form>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeOpen = document.getElementById('eyeOpen');
        const eyeClosed = document.getElementById('eyeClosed');

        togglePassword.addEventListener('click', function() {
            // Ubah type dari input password ke text atau sebaliknya
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Togle class 'hidden' pada SVG mata terbuka dan mata dicoret
            eyeOpen.classList.toggle('hidden');
            eyeClosed.classList.toggle('hidden');
        });
    });
    </script>
</body>

</html>
