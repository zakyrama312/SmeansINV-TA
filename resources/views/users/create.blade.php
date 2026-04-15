<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Tambah Pengguna</h2>
                    <p class="text-sm text-gray-500 mt-1">Buat akun baru untuk admin atau teknisi laboratorium</p>
                </div>
                <a href="{{ route('users.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-sm text-gray-700 hover:bg-gray-50 shadow-sm transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>

            @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 p-4 rounded-xl shadow-sm">
                <div class="flex items-center mb-2">
                    <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                    <p class="text-red-800 font-bold">Mohon periksa kembali inputan Anda:</p>
                </div>
                <ul class="list-disc list-inside text-sm text-red-600 ml-7">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-8 py-5 border-b border-gray-100 flex items-center gap-3 bg-gray-50/50">
                    <div class="p-2 bg-gray-900 rounded-lg">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800">Detail Akun Baru</h3>
                </div>

                <form action="{{ route('users.store') }}" method="POST" class="p-8">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition"
                                placeholder="Masukkan nama pengguna">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Email <span
                                    class="text-red-500">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition"
                                placeholder="contoh@smk.sch.id">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Password <span
                                    class="text-red-500">*</span></label>
                            <input type="password" name="password" required minlength="8"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition"
                                placeholder="Minimal 8 karakter">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Penempatan Prodi/Lab <span
                                    class="text-red-500">*</span></label>
                            <select name="prodi_id" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-3 transition">
                                <option value="" disabled selected>-- Pilih Program Studi --</option>
                                @foreach($prodis as $prodi)
                                <option value="{{ $prodi->id }}" {{ old('prodi_id') == $prodi->id ? 'selected' : '' }}>
                                    {{ $prodi->nama_prodi }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end pt-5 border-t border-gray-100">
                        <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-gray-900 rounded-xl font-bold text-sm text-white hover:bg-gray-800 transition shadow-md">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            Simpan Pengguna
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
