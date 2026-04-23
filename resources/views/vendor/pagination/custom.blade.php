@if ($paginator->hasPages())
<nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">

    <div class="flex justify-between flex-1 sm:hidden">
        @if ($paginator->onFirstPage())
        <span
            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-md">
            Sebelumnya
        </span>
        @else
        <a href="{{ $paginator->previousPageUrl() }}"
            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
            Sebelumnya
        </a>
        @endif

        @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}"
            class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
            Selanjutnya
        </a>
        @else
        <span
            class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-md">
            Selanjutnya
        </span>
        @endif
    </div>

    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
        <div>
            <p class="text-sm text-gray-600 leading-5">
                Menampilkan
                <span class="font-bold text-gray-900">{{ $paginator->firstItem() }}</span>
                sampai
                <span class="font-bold text-gray-900">{{ $paginator->lastItem() }}</span>
                dari
                <span class="font-bold text-gray-900">{{ $paginator->total() }}</span>
                data
            </p>
        </div>

        <div>
            <span class="relative z-0 inline-flex shadow-sm rounded-lg">
                {{-- Tombol Sebelumnya --}}
                @if ($paginator->onFirstPage())
                <span aria-disabled="true" aria-label="Sebelumnya">
                    <span
                        class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-300 bg-gray-50 border border-gray-200 cursor-not-allowed rounded-l-lg"
                        aria-hidden="true">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>
                </span>
                @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                    class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-200 rounded-l-lg hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                    aria-label="Sebelumnya">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
                @endif

                {{-- Elemen Nomor Halaman --}}
                @foreach ($elements as $element)
                {{-- Pemisah Tiga Titik --}}
                @if (is_string($element))
                <span aria-disabled="true">
                    <span
                        class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-200 cursor-default">{{ $element }}</span>
                </span>
                @endif

                {{-- Array Nomor Link --}}
                @if (is_array($element))
                @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                <span aria-current="page">
                    {{-- Desain Angka Aktif (Warna Biru) --}}
                    <span
                        class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-extrabold text-blue-700 bg-blue-50 border border-blue-200 cursor-default z-10">{{ $page }}</span>
                </span>
                @else
                <a href="{{ $url }}"
                    class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-600 bg-white border border-gray-200 hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                    aria-label="Ke halaman {{ $page }}">
                    {{ $page }}
                </a>
                @endif
                @endforeach
                @endif
                @endforeach

                {{-- Tombol Selanjutnya --}}
                @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                    class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-200 rounded-r-lg hover:bg-gray-50 focus:z-10 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                    aria-label="Selanjutnya">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
                @else
                <span aria-disabled="true" aria-label="Selanjutnya">
                    <span
                        class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-300 bg-gray-50 border border-gray-200 cursor-not-allowed rounded-r-lg"
                        aria-hidden="true">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>
                </span>
                @endif
            </span>
        </div>
    </div>
</nav>
@endif
