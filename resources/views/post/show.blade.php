<x-layout>
    <x-slot:title>
        {{ $post->title }} - Berita Kemenag
    </x-slot>

    <div class="bg-gray-50 py-12">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row gap-10">

                <main class="w-full lg:w-2/3">
                    <article class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                        
                        @if($post->featured_image)
                            <div class="w-full h-64 md:h-96 overflow-hidden">
                                <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                            </div>
                        @endif

                        <div class="p-6 md:p-10">
                            <div class="flex flex-wrap items-center gap-4 text-sm text-slate-500 mb-6 border-b border-slate-100 pb-4">
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full font-bold text-xs">
                                    {{ $post->category->name ?? 'Umum' }}
                                </span>
                                <div class="flex items-center gap-1">
                                    <span class="material-icons-outlined text-sm">event</span>
                                    {{ $post->created_at->translatedFormat('l, d F Y') }}
                                </div>
                                <div class="flex items-center gap-1">
                                    <span class="material-icons-outlined text-sm">person</span>
                                    {{ $post->user->name ?? 'Administrator' }}
                                </div>
                            </div>

                            <h1 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6 leading-tight">
                                {{ $post->title }}
                            </h1>

                            <div class="prose prose-slate max-w-none prose-a:text-green-600 prose-img:rounded-xl text-justify">
                                {!! $post->content !!}
                            </div>
                        </div>
                    </article>
                </main>

                <aside class="w-full lg:w-1/3 space-y-8">
                    
                    <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 sticky top-24">
                        <h3 class="font-bold text-slate-900 text-lg mb-4 flex items-center gap-2 border-b border-slate-100 pb-2">
                            <span class="w-1 h-6 bg-green-600 rounded"></span>
                            Berita Terbaru
                        </h3>

                        <div class="space-y-4">
                            @foreach($recentPosts as $recent)
                                <a href="{{ route('post.show', $recent->slug) }}" class="flex gap-3 group">
                                    <div class="w-20 h-20 flex-shrink-0 rounded-lg overflow-hidden bg-slate-100">
                                        @if($recent->featured_image)
                                            <img src="{{ asset('storage/' . $recent->featured_image) }}" class="w-full h-full object-cover group-hover:scale-110 transition">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-slate-400">
                                                <span class="material-icons-outlined text-sm">image</span>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-sm font-bold text-slate-800 line-clamp-2 group-hover:text-green-600 transition leading-snug">
                                            {{ $recent->title }}
                                        </h4>
                                        <span class="text-xs text-slate-400 mt-1 block">
                                            {{ $recent->created_at->format('d M Y') }}
                                        </span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>

                </aside>
            </div>
        </div>
    </div>
</x-layout>