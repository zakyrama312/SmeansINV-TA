<x-app-layout>
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Edit Pengguna</h2>
                    <p class="text-sm text-gray-500 mt-1">Perbarui data akun atau reset password</p>
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

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden relative">

                <div class="px-8 py-5 border-b border-gray-100 flex items-center gap-3 bg-gray-50/50">
                    <div class="p-2 bg-yellow-400 rounded-lg">
                        <svg class="w-5 h-5 text-yellow-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800">Ubah Data Akun: <span
                            class="text-blue-600">{{ $user->name }}</span></h3>
                </div>

                <form action="{{ route('users.update', $user->id) }}" method="POST" class="p-8">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-yellow-500 focus:border-yellow-500 block w-full p-3 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Email <span
                                    class="text-red-500">*</span></label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-yellow-500 focus:border-yellow-500 block w-full p-3 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Password Baru <span
                                    class="text-xs text-gray-400 font-normal ml-1">(Opsional)</span></label>
                            <input type="password" name="password" minlength="8"
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-yellow-500 focus:border-yellow-500 block w-full p-3 transition"
                                placeholder="Biarkan kosong jika tidak diubah">
                            <p class="text-xs text-gray-500 mt-1.5 italic">Isi hanya jika ingin mengganti password akun
                                ini.</p>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Penempatan Prodi/Lab <span
                                    class="text-red-500">*</span></label>
                            <select name="prodi_id" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-yellow-500 focus:border-yellow-500 block w-full p-3 transition">
                                <option value="" disabled>-- Pilih Program Studi --</option>
                                @foreach($prodis as $prodi)
                                <option value="{{ $prodi->id }}"
                                    {{ old('prodi_id', $user->prodi_id) == $prodi->id ? 'selected' : '' }}>
                                    {{ $prodi->nama_prodi }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end pt-5 border-t border-gray-100">
                        <button type="submit"
                            class="inline-flex items-center px-6 py-3 bg-yellow-400 hover:bg-yellow-500 rounded-xl font-bold text-sm text-yellow-900 transition shadow-md">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                </path>
                            </svg>
                            Perbarui Pengguna
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
