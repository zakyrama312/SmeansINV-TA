<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Master Data Kondisi') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-lg relative shadow-sm"
                role="alert">
                <span class="block sm:inline font-medium">{{ session('success') }}</span>
            </div>
            @endif
            @if(session('error'))
            <div class="mb-4 bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded-lg relative shadow-sm"
                role="alert">
                <span class="block sm:inline font-medium">{{ session('error') }}</span>
            </div>
            @endif

            <div class="flex flex-col md:flex-row gap-6">

                <div class="w-full md:w-2/3">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                            <h3 class="font-semibold text-gray-800">Daftar Kondisi</h3>
                            <span
                                class="text-xs bg-blue-100 text-blue-800 px-2.5 py-0.5 rounded-full font-medium">{{ $kondisis->count() }}
                                Kondisi</span>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-500 uppercase bg-white border-b border-gray-100">
                                    <tr>
                                        <th scope="col" class="px-6 py-4 font-semibold w-16 text-center">No</th>
                                        <th scope="col" class="px-6 py-4 font-semibold">Nama Kondisi</th>
                                        <th scope="col" class="px-6 py-4 font-semibold text-right">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50">
                                    @forelse($kondisis as $index => $item)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 text-center font-medium text-gray-900">{{ $index + 1 }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-800 font-medium">{{ $item->nama_kondisi }}</td>
                                        <td class="px-6 py-4 text-right">
                                            <form action="{{ route('kondisi.destroy', $item->id) }}" method="POST"
                                                class="inline-block"
                                                onsubmit="return confirm('Yakin ingin menghapus kondisi ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-500 hover:text-red-700 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-md transition-colors text-xs font-semibold">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                                            Belum ada data kondisi. (Contoh: Alat Praktik, Bahan Habis Pakai)
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-1/3">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-6">
                        <h3 class="font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-100">Tambah Kondisi Baru
                        </h3>

                        <form action="{{ route('kondisi.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kondisi <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="nama_kondisi" required
                                    placeholder="Contoh: Alat Jaringan, Kabel..."
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('nama_kondisi') border-red-500 @enderror"
                                    value="{{ old('nama_kondisi') }}">
                                @error('nama_kondisi')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit"
                                class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-colors shadow-sm">
                                Simpan Kondisi
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>