<x-layout>
    <x-slot:title>
        Berita & Artikel - {{ $settings->site_name ?? 'Kemenag Basel' }}
    </x-slot>

    <div class="bg-slate-900 py-16 text-center relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
        <div class="container mx-auto px-4 relative z-10">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Berita & Artikel</h1>
            <p class="text-slate-400">Informasi terkini seputar kegiatan dan layanan Kementerian Agama.</p>
        </div>
    </div>

    <div class="bg-gray-50 py-12 min-h-screen">
        <div class="container mx-auto px-4">
            
            @if($posts->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($posts as $post)
                        <article class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden hover:shadow-lg transition group flex flex-col h-full">
                            
                            <a href="{{ route('post.show', $post->slug) }}" class="block overflow-hidden h-48 relative">
                                @if($post->featured_image)
                                    <img src="{{ asset('storage/' . $post->featured_image) }}" 
                                         alt="{{ $post->title }}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                @else
                                    <div class="w-full h-full bg-slate-200 flex items-center justify-center text-slate-400">
                                        <span class="material-icons-outlined text-4xl">image</span>
                                    </div>
                                @endif
                                
                                @if($post->category)
                                    <span class="absolute top-4 left-4 bg-green-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">
                                        {{ $post->category->name }}
                                    </span>
                                @endif
                            </a>

                            <div class="p-6 flex flex-col flex-grow">
                                <div class="text-xs text-slate-400 mb-3 flex items-center gap-1">
                                    <span class="material-icons-outlined text-sm">calendar_today</span>
                                    {{ $post->created_at->translatedFormat('d F Y') }}
                                </div>

                                <h3 class="font-bold text-lg text-slate-800 mb-3 leading-snug group-hover:text-green-700 transition">
                                    <a href="{{ route('post.show', $post->slug) }}">
                                        {{ Str::limit($post->title, 60) }}
                                    </a>
                                </h3>

                                <p class="text-slate-500 text-sm line-clamp-3 mb-4 flex-grow">
                                    {{ Str::limit(strip_tags($post->content), 100) }}
                                </p>

                                <a href="{{ route('post.show', $post->slug) }}" class="inline-flex items-center text-sm font-semibold text-green-600 hover:text-green-700 mt-auto">
                                    Baca Selengkapnya 
                                    <span class="material-icons-outlined text-sm ml-1">arrow_forward</span>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $posts->links() }} 
                </div>

            @else
                <div class="text-center py-20">
                    <div class="inline-block p-4 rounded-full bg-slate-100 mb-4">
                        <span class="material-icons-outlined text-4xl text-slate-400">article</span>
                    </div>
                    <h3 class="text-lg font-bold text-slate-700">Belum ada berita</h3>
                    <p class="text-slate-500">Silakan kembali lagi nanti untuk informasi terbaru.</p>
                </div>
            @endif

        </div>
    </div>
</x-layout>