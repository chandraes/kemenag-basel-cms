<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? ($settings->site_name ?? 'Kemenag Basel') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" /> --}}
    @if(isset($settings) && $settings->site_logo)
    <link rel="icon" href="{{ asset('storage/' . $settings->site_logo) }}" type="image/x-icon">
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }

        /* Custom Scrollbar hide */
        .hide-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 font-body antialiased flex flex-col min-h-screen">

    <div class="bg-slate-900 text-gray-300 text-xs py-2 px-4 border-b border-gray-800">
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">

            <div class="flex items-center space-x-4 mb-2 md:mb-0">
                @if($settings?->phone)
                <span class="flex items-center hover:text-white transition">
                    <span class="material-icons-outlined text-sm mr-1">phone</span>
                    {{ $settings->phone }}
                </span>
                @endif

                @if($settings?->email)
                <span class="flex items-center hover:text-white transition">
                    <span class="material-icons-outlined text-sm mr-1">email</span>
                    {{ $settings->email }}
                </span>
                @endif
            </div>

            @if($settings?->operational_hours)
            <div>
                <span class="flex items-center text-center md:text-right">
                    <span class="material-icons-outlined text-sm mr-1 md:hidden">schedule</span>
                    Jam Operasional: {{ $settings->operational_hours }}
                </span>
            </div>
            @endif
        </div>
    </div>

    <nav class="bg-white shadow-md sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
        <div class="container mx-auto px-4">
            <div class="flex justify-between h-20">

                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center gap-3 group">
                        @if(isset($settings) && $settings->site_logo)
                        <img src="{{ asset('storage/' . $settings->site_logo) }}" alt="Logo"
                            class="h-10 w-10 object-contain">
                        @else
                        <div
                            class="h-10 w-10 bg-green-700 rounded-full flex items-center justify-center text-white font-bold group-hover:bg-green-800 transition">
                            <span class="material-icons-outlined">stars</span>
                        </div>
                        @endif

                        <div class="flex flex-col">
                            <span
                                class="font-bold text-gray-900 text-lg leading-tight group-hover:text-green-700 transition">
                                {{ $settings->site_name ?? 'Kantor Kementerian Agama' }}
                            </span>
                            <span class="text-sm text-gray-500">
                                {{ $settings->site_description ?? 'Kabupaten Bangka Selatan' }}
                            </span>
                        </div>
                    </a>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}"
                        class="{{ request()->routeIs('home') ? 'text-blue-700 border-b-2 border-blue-700' : 'text-gray-600 hover:text-blue-700' }} font-medium pb-1 transition">
                        Beranda
                    </a>

                    <div class="relative group" x-data="{ open: false }" @mouseenter="open = true"
                        @mouseleave="open = false">
                        <button
                            class="flex items-center text-gray-600 hover:text-blue-700 transition font-medium focus:outline-none py-4 {{ request()->is('profil*') ? 'text-blue-700' : '' }}">
                            Profil
                            <span class="material-icons-outlined text-sm ml-1 transition-transform duration-200"
                                :class="open ? 'rotate-180' : ''">expand_more</span>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="absolute left-0 mt-0 w-56 bg-white rounded-xl shadow-xl border border-slate-100 overflow-hidden z-50"
                            x-cloak>
                            <div class="py-2">
                                @if(isset($globalPages) && $globalPages->count() > 0)
                                @foreach($globalPages as $p)
                                <a href="{{ route('page.show', $p->slug) }}"
                                    class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">
                                    {{ $p->title }}
                                </a>
                                @endforeach
                                @else
                                <span class="block px-4 py-2 text-xs text-gray-400 italic">Belum ada data</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('post.index') }}"
                        class="{{ request()->routeIs('post.*') ? 'text-blue-700 border-b-2 border-blue-700' : 'text-gray-600 hover:text-blue-700' }} font-medium pb-1 transition">
                        Berita
                    </a>

                    <a href="{{ route('contact') }}"
                        class="{{ request()->routeIs('contact') ? 'text-blue-700 border-b-2 border-blue-700' : 'text-gray-600 hover:text-blue-700' }} font-medium pb-1 transition">
                        Kontak
                    </a>
                </div>

                <div class="flex items-center md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="p-2 rounded-md text-gray-600 hover:bg-gray-100 focus:outline-none">
                        <span class="material-icons-outlined text-2xl" x-show="!mobileMenuOpen">menu</span>
                        <span class="material-icons-outlined text-2xl" x-show="mobileMenuOpen" x-cloak>close</span>
                    </button>
                </div>
            </div>
        </div>

        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="md:hidden bg-white border-t border-gray-100 absolute w-full left-0 shadow-lg overflow-y-auto max-h-[80vh]"
            x-cloak>

            <div class="px-4 pt-4 pb-6 space-y-2">

                <a href="{{ route('home') }}"
                    class="block px-4 py-3 rounded-lg text-base font-medium transition {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50 hover:text-blue-700' }}">
                    Beranda
                </a>

                <div x-data="{ expanded: false }">
                    <button @click="expanded = !expanded"
                        class="w-full flex justify-between items-center px-4 py-3 rounded-lg text-base font-medium transition {{ request()->is('profil*') ? 'text-blue-700 bg-blue-50' : 'text-gray-600 hover:bg-gray-50 hover:text-blue-700' }}">
                        <span>Profil</span>
                        <span class="material-icons-outlined text-sm transition-transform duration-200"
                            :class="expanded ? 'rotate-180' : ''">expand_more</span>
                    </button>
                    <div x-show="expanded" x-collapse class="pl-4 pr-2 space-y-1 mt-1">
                        @if(isset($globalPages) && $globalPages->count() > 0)
                        @foreach($globalPages as $p)
                        <a href="{{ route('page.show', $p->slug) }}"
                            class="block px-4 py-2 rounded-md text-sm {{ request()->url() == route('page.show', $p->slug) ? 'text-blue-600 font-bold bg-blue-50' : 'text-gray-500 hover:text-blue-600' }}">
                            {{ $p->title }}
                        </a>
                        @endforeach
                        @endif
                    </div>
                </div>

                <a href="{{ route('post.index') }}"
                    class="block px-4 py-3 rounded-lg text-base font-medium transition {{ request()->routeIs('post.*') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50 hover:text-blue-700' }}">
                    Berita
                </a>

                <a href="{{ route('contact') }}"
                    class="block px-4 py-3 rounded-lg text-base font-medium transition {{ request()->routeIs('contact') ? 'bg-blue-50 text-blue-700' : 'text-gray-600 hover:bg-gray-50 hover:text-blue-700' }}">
                    Kontak
                </a>

            </div>
        </div>
    </nav>

    <main class="flex-grow">
        {{ $slot }}
    </main>

    <footer class="bg-slate-900 text-slate-300 border-t border-slate-800 font-sans">
        <div class="container mx-auto px-4 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">

                <div>
                    <div class="flex items-center gap-3 mb-6">
                        @if($settings->site_logo)
                        <img src="{{ asset('storage/' . $settings->site_logo) }}" alt="Logo" class="h-12 w-auto">
                        @else
                        <div
                            class="h-12 w-12 bg-green-700 rounded-full flex items-center justify-center text-white font-bold">
                            KA</div>
                        @endif
                        <div>
                            <h3 class="text-white font-bold text-lg leading-none">{{ $settings->site_name ?? 'Kemenag
                                Basel' }}</h3>
                            <p class="text-xs text-slate-400 mt-1">Ikhlas Beramal</p>
                        </div>
                    </div>

                    <p class="text-sm text-slate-400 leading-relaxed mb-6">
                        Website resmi Kantor Kementerian Agama Kabupaten Bangka Selatan. Menyediakan informasi terkini
                        seputar layanan keagamaan dan pendidikan.
                    </p>

                    <ul class="space-y-4">
                        <li class="flex items-start gap-3">
                            <span class="material-icons-outlined text-green-500 mt-0.5">location_on</span>
                            <span class="text-sm">{{ $settings->address ?? 'Alamat kantor belum diisi.' }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="material-icons-outlined text-green-500">call</span>
                            <span class="text-sm">{{ $settings->phone ?? '-' }}</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span class="material-icons-outlined text-green-500">email</span>
                            <span class="text-sm">{{ $settings->email ?? '-' }}</span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-bold text-lg mb-6 flex items-center gap-2">
                        <span class="w-1 h-6 bg-green-600 rounded"></span> Tautan Cepat
                    </h4>

                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="hover:text-green-400 transition flex items-center gap-2"><span
                                    class="material-icons-outlined text-xs">chevron_right</span> Profil Kantor</a></li>
                        <li><a href="#" class="hover:text-green-400 transition flex items-center gap-2"><span
                                    class="material-icons-outlined text-xs">chevron_right</span> Layanan PTSP</a></li>
                        <li><a href="#" class="hover:text-green-400 transition flex items-center gap-2"><span
                                    class="material-icons-outlined text-xs">chevron_right</span> Simpeg Kemenag</a></li>
                        <li><a href="#" class="hover:text-green-400 transition flex items-center gap-2"><span
                                    class="material-icons-outlined text-xs">chevron_right</span> Berita Daerah</a></li>
                    </ul>

                    <h4 class="text-white font-bold text-lg mt-8 mb-4">Ikuti Kami</h4>
                    <div class="flex gap-4">
                        @if($settings->facebook)
                        <a href="{{ $settings->facebook }}" target="_blank"
                            class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-blue-600 hover:text-white transition">
                            <span class="material-icons-outlined">facebook</span>
                        </a>
                        @endif
                        @if($settings->instagram)
                        <a href="{{ $settings->instagram }}" target="_blank"
                            class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-pink-600 hover:text-white transition">
                            <span class="material-icons-outlined">camera_alt</span> </a>
                        @endif
                        @if($settings->youtube)
                        <a href="{{ $settings->youtube }}" target="_blank"
                            class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-red-600 hover:text-white transition">
                            <span class="material-icons-outlined">play_arrow</span>
                        </a>
                        @endif
                        @if($settings->tiktok)
                        <a href="{{ $settings->tiktok }}" target="_blank"
                            class="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center hover:bg-black hover:text-white transition">
                            {{-- Menggunakan ikon musik sebagai representasi TikTok --}}
                            <span class="material-icons-outlined">music_note</span>
                        </a>
                        @endif
                    </div>
                </div>

                <div>
                    <h4 class="text-white font-bold text-lg mb-6 flex items-center gap-2">
                        <span class="w-1 h-6 bg-green-600 rounded"></span> Lokasi Kantor
                    </h4>

                    <div class="w-full h-64 bg-slate-800 rounded-xl overflow-hidden border border-slate-700 relative">
                        @if($settings->google_maps_embed)
                        <div class="custom-map-container w-full h-full">
                            {!! $settings->google_maps_embed !!}
                        </div>
                        @else
                        <div class="w-full h-full flex flex-col items-center justify-center text-slate-500">
                            <span class="material-icons-outlined text-4xl mb-2">map</span>
                            <span class="text-xs">Peta belum disematkan</span>
                        </div>
                        @endif
                    </div>
                    <a href="https://maps.google.com" target="_blank"
                        class="inline-block mt-4 text-xs text-green-500 hover:text-green-400 font-medium">
                        Buka di Google Maps &rarr;
                    </a>
                </div>

            </div>
        </div>

        <div class="bg-slate-950 py-6 border-t border-slate-800">
            <div
                class="container mx-auto px-4 text-center md:text-left flex flex-col md:flex-row justify-between items-center text-xs text-slate-500">
                <p>&copy; {{ date('Y') }} {{ $settings->site_name ?? 'Kemenag Bangka Selatan' }}. All rights reserved.
                </p>
                <p class="mt-2 md:mt-0">Dikelola oleh Tim Humas & Data Informasi</p>
            </div>
        </div>
    </footer>

    <style>
        .custom-map-container iframe {
            width: 100% !important;
            height: 100% !important;
            border: 0;
        }
    </style>

</body>

</html>
