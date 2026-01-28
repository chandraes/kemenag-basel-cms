<x-layout>
   <section class="relative bg-blue-900 overflow-hidden py-16 lg:py-24">
    <div class="container mx-auto px-4">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <div class="order-2 lg:order-1 relative z-10">

                @if($heroPost)
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-100 text-blue-800 text-xs font-bold mb-6 uppercase tracking-wider">
                        <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
                        Berita Utama
                    </div>

                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-slate-900 leading-tight mb-6">
                        {{ $heroPost->title }}
                    </h1>

                    <p class="text-lg text-slate-600 mb-8 leading-relaxed max-w-lg">
                        {{ $heroPost->excerpt }}
                    </p>

                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('post.show', $heroPost->slug) }}" class="px-7 py-3.5 bg-blue-700 hover:bg-blue-800 text-white font-semibold rounded-xl transition duration-300 shadow-lg shadow-blue-900/20 flex items-center gap-2">
                            Baca Selengkapnya
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </a>
                    </div>

                @else
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-green-100 text-green-800 text-xs font-bold mb-6 uppercase tracking-wider">
                        Selamat Datang
                    </div>

                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                        {{ $settings->hero_title ?? 'Membangun Masyarakat Saleh, Moderat, Cerdas dan Unggul' }}
                    </h1>

                    <p class="text-lg text-white mb-8 leading-relaxed max-w-lg">
                        {{ $settings->hero_description ?? 'Website resmi Kantor Kementerian Agama Kabupaten Bangka Selatan. Melayani dengan Ikhlas, Beramal dengan Cerdas.' }}
                    </p>

                    <div class="flex flex-wrap gap-4">
                        @if($settings->hero_cta_url)
                        <a href="{{ $settings->hero_cta_url }}" class="px-7 py-3.5 bg-blue-700 hover:bg-blue-800 text-white font-semibold rounded-xl transition duration-300 shadow-lg shadow-blue-900/20">
                            {{ $settings->hero_cta_text ?? 'Jelajahi Layanan' }}
                        </a>
                        @endif

                        <a href="#berita" class="px-7 py-3.5 bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 hover:text-blue-700 font-semibold rounded-xl transition duration-300">
                            Berita Terkini
                        </a>
                    </div>
                @endif
            </div>

            <div class="order-1 lg:order-2 relative">

                <div class="absolute -top-10 -right-10 w-72 h-72 bg-blue-100 rounded-full blur-3xl opacity-50 pointer-events-none"></div>
                <div class="absolute -bottom-10 -left-10 w-72 h-72 bg-green-100 rounded-full blur-3xl opacity-50 pointer-events-none"></div>

                <div class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-white transform hover:scale-[1.01] transition duration-500">
                    @if($heroPost && $heroPost->featured_image)
                        <img src="{{ asset('storage/' . $heroPost->featured_image) }}"
                             alt="{{ $heroPost->title }}"
                             class="w-full aspect-[4/3] object-cover bg-slate-200">
                    @else
                        <img src="{{ $settings->hero_bg_image ? asset('storage/' . $settings->hero_bg_image) : 'https://images.unsplash.com/photo-1557804506-669a67965ba0?q=80&w=1974&auto=format&fit=crop' }}"
                             alt="Kantor Kemenag"
                             class="w-full aspect-[4/3] object-cover bg-slate-200">
                    @endif

                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                </div>

            </div>

        </div>
    </div>
</section>
<section class="relative z-20 -mt-16 md:-mt-20 pb-12">
    <div class="container mx-auto px-4">

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4 md:gap-6">

            @forelse($quickLinks as $link)
                <a href="{{ $link->url }}" target="{{ $link->target }}"
                   class="bg-white rounded-xl shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 p-6 flex flex-col items-center text-center group border border-gray-100 h-full justify-center">

                    <div class="w-14 h-14 rounded-full flex items-center justify-center text-white mb-4 shadow-md transition-transform group-hover:scale-110 duration-300"
                         style="background-color: {{ $link->color }};">
                        <span class="material-icons-outlined text-3xl">
                            {{ $link->icon_name }}
                        </span>
                    </div>

                    <h3 class="font-bold text-gray-800 text-sm md:text-base group-hover:text-blue-700 transition leading-tight">
                        {{ $link->title }}
                    </h3>

                    <div class="mt-2 opacity-0 group-hover:opacity-100 transition duration-300 text-gray-400">
                        <span class="material-icons-outlined text-sm">arrow_forward</span>
                    </div>
                </a>
            @empty
                <div class="col-span-full bg-white rounded-xl shadow-md p-6 text-center border-l-4 border-yellow-400">
                    <p class="text-gray-500">Belum ada link layanan yang ditambahkan admin.</p>
                </div>
            @endforelse

        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 bg-white border-t border-slate-100">
    <div class="grid md:grid-cols-2 gap-12 items-center">

        <div>
            <h2 class="text-3xl font-bold text-slate-900 mb-2">Lima Nilai Budaya Kerja</h2>
            <h3 class="text-xl text-slate-500 mb-8 font-medium">Kementerian Agama RI</h3>

            <div class="space-y-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-8 w-8 rounded-full bg-green-700 text-white font-bold text-sm">1</div>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-lg font-bold text-green-800">Integritas</h4>
                        <p class="text-slate-600 text-sm">Keselarasan antara hati, pikiran, perkataan, dan perbuatan yang baik dan benar.</p>
                    </div>
                </div>

                <div class="flex">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-8 w-8 rounded-full bg-green-700 text-white font-bold text-sm">2</div>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-lg font-bold text-green-800">Profesionalitas</h4>
                        <p class="text-slate-600 text-sm">Bekerja secara disiplin, kompeten, dan tepat waktu dengan hasil terbaik.</p>
                    </div>
                </div>

                <div class="flex">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-8 w-8 rounded-full bg-green-700 text-white font-bold text-sm">3</div>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-lg font-bold text-green-800">Inovasi</h4>
                        <p class="text-slate-600 text-sm">Menyempurnakan yang sudah ada dan mengkreasi hal baru yang lebih baik.</p>
                    </div>
                </div>

                <div class="flex">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-8 w-8 rounded-full bg-green-700 text-white font-bold text-sm">4</div>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-lg font-bold text-green-800">Tanggung Jawab</h4>
                        <p class="text-slate-600 text-sm">Bekerja secara tuntas dan konsekuen.</p>
                    </div>
                </div>

                <div class="flex">
                    <div class="flex-shrink-0">
                        <div class="flex items-center justify-center h-8 w-8 rounded-full bg-green-700 text-white font-bold text-sm">5</div>
                    </div>
                    <div class="ml-4">
                        <h4 class="text-lg font-bold text-green-800">Keteladanan</h4>
                        <p class="text-slate-600 text-sm">Menjadi contoh yang baik bagi orang lain.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-slate-50 rounded-2xl p-8 text-center relative shadow-inner border border-slate-200">
            <div class="w-32 h-32 mx-auto mb-4 relative">
                @if($settings->kakan_photo)
                    <img src="{{ asset('storage/' . $settings->kakan_photo) }}"
                         alt="{{ $settings->kakan_name }}"
                         class="w-full h-full rounded-full border-4 border-white shadow-md object-cover">
                @else
                    <div class="w-full h-full rounded-full border-4 border-white shadow-md bg-slate-300 flex items-center justify-center text-slate-500">
                        <span class="material-icons-outlined text-4xl">person</span>
                    </div>
                @endif
            </div>

            <h4 class="text-xl font-bold text-slate-900">{{ $settings->kakan_name ?? 'Nama Kepala Kantor' }}</h4>
            <p class="text-sm text-slate-500 mb-6">Kepala Kantor Kementerian Agama Kab. Bangka Selatan</p>

            <div class="relative">
                <span class="absolute top-0 left-0 text-4xl text-slate-300 font-serif">“</span>
                <p class="text-slate-600 italic text-sm leading-relaxed px-6">
                    {{ $settings->kakan_message ?? 'Selamat datang di website resmi kami. Kami berkomitmen memberikan pelayanan terbaik bagi masyarakat.' }}
                </p>
                <span class="absolute bottom-0 right-0 text-4xl text-slate-300 font-serif">”</span>
            </div>

            <div class="mt-8 flex justify-center space-x-4">
                <a href="#" class="px-6 py-2 bg-green-700 hover:bg-green-800 text-white rounded text-sm font-medium transition">
                    Sejarah
                </a>
                <a href="#" class="px-6 py-2 border border-green-700 text-green-700 hover:bg-green-50 rounded text-sm font-medium transition">
                    Visi Misi
                </a>
            </div>
        </div>

    </div>
</section>
<section id="berita" class="py-16 lg:py-24 bg-gray-50">
    <div class="container mx-auto px-4">

        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
            <div>
                <span class="text-blue-600 font-bold tracking-wider uppercase text-sm">Informasi Terkini</span>
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mt-2">Berita & Artikel</h2>
                <div class="h-1 w-20 bg-blue-600 rounded mt-4"></div>
            </div>

            <a href="#" class="inline-flex items-center justify-center px-6 py-3 border border-slate-300 shadow-sm text-sm font-medium rounded-lg text-slate-700 bg-white hover:bg-slate-50 transition duration-300">
                Lihat Semua Berita
                <svg class="ml-2 -mr-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

            @forelse($latestPosts as $post)
                <article class="flex flex-col bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition duration-300 group h-full">

                    <div class="relative h-56 overflow-hidden">
                        <a href="{{ route('post.show', $post->slug) }}">
                            @if($post->featured_image)
                                <img src="{{ asset('storage/' . $post->featured_image) }}"
                                     alt="{{ $post->title }}"
                                     class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                            @else
                                <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-400">
                                    <span class="material-icons-outlined text-5xl">image</span>
                                </div>
                            @endif
                        </a>

                        <div class="absolute top-4 left-4 bg-white/95 backdrop-blur px-3 py-1.5 rounded-lg text-xs font-bold text-slate-800 shadow-sm border border-slate-100 flex items-center gap-1">
                            <span class="material-icons-outlined text-sm text-blue-600">event</span>
                            {{ $post->published_at->format('d M Y') }}
                        </div>
                    </div>

                    <div class="p-6 flex flex-col flex-grow">
                        <div class="mb-3">
                            <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-2 py-1 rounded">
                                Berita
                            </span>
                        </div>

                        <h3 class="text-xl font-bold text-slate-900 mb-3 line-clamp-2 leading-snug group-hover:text-blue-600 transition">
                            <a href="{{ route('post.show', $post->slug) }}">
                                {{ $post->title }}
                            </a>
                        </h3>

                        <p class="text-slate-500 text-sm line-clamp-3 mb-6 flex-grow leading-relaxed">
                            {{Str::limit(strip_tags($post->content), 120)}}
                        </p>

                        <div class="pt-6 border-t border-slate-100 flex items-center justify-between mt-auto">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-slate-200 flex items-center justify-center text-slate-500 text-xs">
                                    <span class="material-icons-outlined text-sm">person</span>
                                </div>
                                <span class="text-xs text-slate-500 font-medium">Admin</span>
                            </div>

                            <a href="{{ route('post.show', $post->slug) }}" class="text-blue-600 text-sm font-semibold hover:text-blue-800 flex items-center gap-1">
                                Baca
                                <span class="material-icons-outlined text-sm">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full text-center py-20 bg-white rounded-2xl border border-dashed border-slate-300">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-100 mb-4">
                        <span class="material-icons-outlined text-3xl text-slate-400">newspaper</span>
                    </div>
                    <h3 class="text-lg font-medium text-slate-900">Belum ada berita</h3>
                    <p class="text-slate-500 mt-1">Berita terbaru akan muncul di sini.</p>
                </div>
            @endforelse

        </div>
    </div>
</section>
<section class="py-16 bg-white border-t border-slate-100 overflow-hidden">
    <div class="container mx-auto px-4">

        <div class="flex flex-col md:flex-row justify-between items-end mb-10 px-2">
            <div class="max-w-2xl">
                <span class="text-blue-600 font-bold tracking-wider uppercase text-sm">Struktur Organisasi</span>
                <h2 class="text-3xl font-bold text-slate-900 mt-2">Pejabat Struktural</h2>
                <div class="h-1 w-20 bg-blue-600 rounded mt-3"></div>
            </div>

            <div class="flex gap-3 mt-4 md:mt-0">
                <button onclick="scrollPejabat('left')" class="w-10 h-10 rounded-full border border-slate-300 flex items-center justify-center text-slate-600 hover:bg-blue-600 hover:text-white hover:border-blue-600 transition shadow-sm">
                    <span class="material-icons-outlined">chevron_left</span>
                </button>
                <button onclick="scrollPejabat('right')" class="w-10 h-10 rounded-full border border-slate-300 flex items-center justify-center text-slate-600 hover:bg-blue-600 hover:text-white hover:border-blue-600 transition shadow-sm">
                    <span class="material-icons-outlined">chevron_right</span>
                </button>
            </div>
        </div>

        <div class="relative">
            <div class="absolute left-0 top-0 bottom-0 w-8 bg-gradient-to-r from-white to-transparent z-10 pointer-events-none md:hidden"></div>
            <div class="absolute right-0 top-0 bottom-0 w-8 bg-gradient-to-l from-white to-transparent z-10 pointer-events-none md:hidden"></div>

            <div id="pejabat-container" class="flex overflow-x-auto gap-6 pb-8 snap-x snap-mandatory scroll-smooth scrollbar-hide px-2">

                @forelse($structurals as $official)
                    <div class="flex-none w-64 snap-center group">
                        <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm hover:shadow-xl transition-all duration-300 text-center h-full flex flex-col items-center justify-center relative overflow-hidden">

                            <div class="absolute top-0 w-full h-1 bg-gradient-to-r from-blue-400 to-green-400 transform scale-x-0 group-hover:scale-x-100 transition duration-500"></div>

                            <div class="relative w-32 h-32 mb-4">
                                <div class="absolute inset-0 bg-blue-100 rounded-full transform rotate-6 group-hover:rotate-0 transition duration-500"></div>
                                @if($official->photo)
                                    <img src="{{ asset('storage/' . $official->photo) }}"
                                         alt="{{ $official->name }}"
                                         class="relative w-full h-full rounded-full object-cover border-4 border-white shadow-md z-10">
                                @else
                                    <div class="relative w-full h-full rounded-full bg-slate-200 border-4 border-white shadow-md z-10 flex items-center justify-center text-slate-400">
                                        <span class="material-icons-outlined text-4xl">person</span>
                                    </div>
                                @endif
                            </div>

                            <h3 class="text-lg font-bold text-slate-900 group-hover:text-blue-700 transition leading-snug mb-1">
                                {{ $official->name }}
                            </h3>
                            <p class="text-xs font-bold text-slate-500 uppercase tracking-wide border-t border-slate-100 pt-3 mt-2 w-full">
                                {{ $official->position }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="w-full text-center py-10 bg-slate-50 rounded-xl border border-dashed border-slate-300">
                        <p class="text-slate-400 italic">Data pejabat belum diinput.</p>
                    </div>
                @endforelse

            </div>
        </div>

    </div>
</section>

<style>
    /* Menyembunyikan Scrollbar default browser agar terlihat bersih */
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

<script>
    function scrollPejabat(direction) {
        const container = document.getElementById('pejabat-container');
        const scrollAmount = 300; // Jarak scroll per klik (pixel)

        if (direction === 'left') {
            container.scrollLeft -= scrollAmount;
        } else {
            container.scrollLeft += scrollAmount;
        }
    }
</script>

<section class="py-16 lg:py-24 bg-slate-50 border-t border-slate-200 overflow-hidden">
    <div class="container mx-auto px-4">

        <div class="flex flex-col md:flex-row justify-between items-end mb-10 px-2">
            <div class="max-w-2xl">
                <span class="text-green-600 font-bold tracking-wider uppercase text-sm">Sarana & Prasarana</span>
                <h2 class="text-3xl font-bold text-slate-900 mt-2">Fasilitas Layanan</h2>
                <div class="h-1 w-20 bg-green-600 rounded mt-3"></div>
                <p class="text-slate-500 mt-4 text-sm md:text-base">
                    Standar pelayanan kami didukung dengan fasilitas yang memadai.
                </p>
            </div>

            <div class="flex gap-3 mt-6 md:mt-0">
                <button onclick="scrollFasilitas('left')" class="w-10 h-10 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:bg-green-600 hover:text-white hover:border-green-600 transition shadow-sm z-10">
                    <span class="material-icons-outlined">chevron_left</span>
                </button>
                <button onclick="scrollFasilitas('right')" class="w-10 h-10 rounded-full bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:bg-green-600 hover:text-white hover:border-green-600 transition shadow-sm z-10">
                    <span class="material-icons-outlined">chevron_right</span>
                </button>
            </div>
        </div>

        <div class="relative">
             <div class="absolute left-0 top-0 bottom-0 w-8 bg-gradient-to-r from-slate-50 to-transparent z-10 pointer-events-none md:hidden"></div>
            <div class="absolute right-0 top-0 bottom-0 w-8 bg-gradient-to-l from-slate-50 to-transparent z-10 pointer-events-none md:hidden"></div>

            <div id="fasilitas-container" class="flex overflow-x-auto gap-6 pb-8 snap-x snap-mandatory scroll-smooth scrollbar-hide px-2">

                @forelse($facilities as $facility)
                    <div class="flex-none w-full sm:w-1/2 md:w-1/3 lg:w-72 xl:w-80 snap-center">
                        <div class="group relative rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-300 bg-white h-96">

                            @if($facility->image)
                                <img src="{{ asset('storage/' . $facility->image) }}"
                                     alt="{{ $facility->name }}"
                                     class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                            @else
                                <div class="w-full h-full bg-slate-200 flex items-center justify-center text-slate-400">
                                    <span class="material-icons-outlined text-6xl">apartment</span>
                                </div>
                            @endif

                            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent opacity-70 group-hover:opacity-90 transition duration-300"></div>

                            <div class="absolute bottom-0 left-0 w-full p-6 translate-y-4 group-hover:translate-y-0 transition duration-300">

                                <div class="mb-3 opacity-0 group-hover:opacity-100 transform -translate-y-2 group-hover:translate-y-0 transition duration-500 delay-100">
                                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-green-500/20 backdrop-blur border border-green-500 text-green-400">
                                        <span class="material-icons-outlined text-xl">check</span>
                                    </span>
                                </div>

                                <h3 class="text-xl font-bold text-white mb-2 leading-tight drop-shadow-md">
                                    {{ $facility->name }}
                                </h3>

                                <div class="h-0 group-hover:h-auto overflow-hidden transition-all duration-300">
                                    <p class="text-gray-300 text-sm line-clamp-3 opacity-0 group-hover:opacity-100 transition duration-500 delay-200">
                                        {{ $facility->description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="w-full text-center py-12 border-2 border-dashed border-slate-300 rounded-xl">
                        <p class="text-slate-400">Data fasilitas belum ditambahkan.</p>
                    </div>
                @endforelse

            </div>
        </div>

    </div>
</section>

<script>
    // Fungsi Scroll Khusus Fasilitas
    function scrollFasilitas(direction) {
        const container = document.getElementById('fasilitas-container');
        const scrollAmount = 320; // Sesuaikan dengan lebar kartu

        if (direction === 'left') {
            container.scrollLeft -= scrollAmount;
        } else {
            container.scrollLeft += scrollAmount;
        }
    }
</script>

<section class="relative py-20 bg-fixed bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1556761175-5973dc0f32e7?q=80&w=2032&auto=format&fit=crop');">

    <div class="absolute inset-0 bg-slate-900/80"></div>

    <div class="container mx-auto px-4 relative z-10">

        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Data & Statistik</h2>
            <div class="h-1 w-24 bg-yellow-500 rounded mx-auto mb-4"></div>
            <p class="text-slate-300 max-w-2xl mx-auto">
                Gambaran umum capaian dan data terkini Kantor Kementerian Agama Kabupaten Bangka Selatan dalam angka.
            </p>
        </div>

        <div class="relative overflow-hidden w-full" id="stats-container">

            <div id="stats-track" class="flex transition-transform duration-700 ease-in-out">

                @forelse($statistics as $stat)
                    <div class="w-full md:w-1/2 lg:w-1/4 shrink-0 px-3">
                        <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-6 text-center h-full hover:bg-white/15 transition duration-300 cursor-pointer">

                            <div class="w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center bg-white shadow-lg relative">
                                <div class="absolute inset-0 rounded-full border-2 opacity-50
                                    {{ $stat->color == 'blue' ? 'border-blue-500' : '' }}
                                    {{ $stat->color == 'green' ? 'border-green-500' : '' }}
                                    {{ $stat->color == 'red' ? 'border-red-500' : '' }}
                                    {{ $stat->color == 'yellow' ? 'border-yellow-500' : '' }}
                                "></div>

                                <span class="material-icons-outlined text-3xl
                                    {{ $stat->color == 'blue' ? 'text-blue-600' : '' }}
                                    {{ $stat->color == 'green' ? 'text-green-600' : '' }}
                                    {{ $stat->color == 'red' ? 'text-red-600' : '' }}
                                    {{ $stat->color == 'yellow' ? 'text-yellow-600' : '' }}
                                ">
                                    {{ $stat->icon }}
                                </span>
                            </div>

                            <div class="text-3xl md:text-4xl font-bold text-white mb-2 tracking-tight">
                                {{ $stat->value }}
                            </div>

                            <p class="text-slate-300 text-sm md:text-base font-medium uppercase tracking-wide">
                                {{ $stat->label }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="w-full text-center text-slate-400 py-10">
                        Data statistik belum diinput.
                    </div>
                @endforelse

            </div>

            <button onclick="moveSlide(-1)" class="absolute left-0 top-1/2 -translate-y-1/2 bg-slate-800/50 hover:bg-slate-700 text-white p-2 rounded-r-lg backdrop-blur-sm z-20">
                <span class="material-icons-outlined">chevron_left</span>
            </button>
            <button onclick="moveSlide(1)" class="absolute right-0 top-1/2 -translate-y-1/2 bg-slate-800/50 hover:bg-slate-700 text-white p-2 rounded-l-lg backdrop-blur-sm z-20">
                <span class="material-icons-outlined">chevron_right</span>
            </button>
        </div>

    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const track = document.getElementById('stats-track');
        const container = document.getElementById('stats-container');
        const items = track.children;
        const totalItems = items.length;

        let currentIndex = 0;
        let autoPlayInterval;

        // Fungsi untuk menghitung berapa item yang terlihat di layar saat ini
        function getItemsPerScreen() {
            if (window.innerWidth >= 1024) return 4; // Desktop lg
            if (window.innerWidth >= 768) return 2;  // Tablet md
            return 1;                                // Mobile
        }

        // Fungsi utama untuk menggeser slide
        window.moveSlide = function(direction) {
            const itemsPerScreen = getItemsPerScreen();
            const maxIndex = totalItems - itemsPerScreen;

            currentIndex += direction;

            // Logika Looping:
            // Jika sudah di akhir, kembali ke awal
            if (currentIndex > maxIndex) {
                currentIndex = 0;
            }
            // Jika mundur dari awal, pergi ke akhir
            else if (currentIndex < 0) {
                currentIndex = maxIndex;
            }

            // Hitung persentase geser (100% dibagi jumlah item per layar)
            const translateX = currentIndex * (100 / itemsPerScreen);
            track.style.transform = `translateX(-${translateX}%)`;
        }

        // Fungsi Autoplay
        function startAutoPlay() {
            // Jalankan setiap 3 detik (3000ms)
            autoPlayInterval = setInterval(() => {
                moveSlide(1);
            }, 3000);
        }

        function stopAutoPlay() {
            clearInterval(autoPlayInterval);
        }

        // Jalankan Autoplay saat halaman dimuat
        startAutoPlay();

        // Fitur Tambahan: Berhenti saat mouse diarahkan (supaya user bisa baca)
        // dan jalan lagi saat mouse pergi
        container.addEventListener('mouseenter', stopAutoPlay);
        container.addEventListener('mouseleave', startAutoPlay);

        // Reset posisi jika ukuran layar berubah (responsif)
        window.addEventListener('resize', () => {
            currentIndex = 0;
            track.style.transform = `translateX(0%)`;
        });
    });
</script>
</x-layout>
