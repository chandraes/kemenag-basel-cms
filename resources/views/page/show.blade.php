<x-layout>
    
    <x-slot:title>
        {{ $page->title }} - Kementerian Agama Bangka Selatan
    </x-slot>

    <header class="relative h-64 md:h-80 bg-slate-900 flex items-center justify-center overflow-hidden">
        @if($page->image)
            <img src="{{ asset('storage/' . $page->image) }}" 
                 alt="{{ $page->title }}" 
                 class="absolute inset-0 w-full h-full object-cover opacity-60">
        @else
            <div class="absolute inset-0 bg-gradient-to-r from-green-800 to-blue-900 opacity-90"></div>
            <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#ffffff 1px, transparent 1px); background-size: 20px 20px;"></div>
        @endif
        
        <div class="relative z-10 text-center px-4 mt-8">
            <span class="text-green-400 font-bold tracking-wider uppercase text-sm mb-2 block animate-fade-in-up">
                Profil Instansi
            </span>
            <h1 class="text-3xl md:text-5xl font-bold text-white drop-shadow-lg">
                {{ $page->title }}
            </h1>
            <div class="h-1.5 w-24 bg-green-500 rounded mx-auto mt-4 shadow-lg"></div>
        </div>
    </header>

    <div class="bg-gray-50 py-12 md:py-16">
        <div class="container mx-auto px-4">
            
            <div class="flex flex-col lg:flex-row gap-10">
                
                <aside class="w-full lg:w-1/4">
                    <div class="bg-white rounded-xl shadow-md border border-slate-100 p-6 sticky top-24">
                        <h3 class="font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
                            <span class="material-icons-outlined text-green-600">toc</span>
                            Menu Profil
                        </h3>
                        
                        <nav class="space-y-1">
                            @foreach($allPages as $navItem)
                                <a href="{{ route('page.show', $navItem->slug) }}" 
                                   class="group flex items-center justify-between px-4 py-3 rounded-lg text-sm font-medium transition-all duration-200
                                   {{ $navItem->id === $page->id 
                                       ? 'bg-green-50 text-green-700 border-l-4 border-green-600 shadow-sm' 
                                       : 'text-slate-600 hover:bg-slate-50 hover:text-green-600 hover:pl-6' }}">
                                    
                                    <span>{{ $navItem->title }}</span>
                                    
                                    @if($navItem->id === $page->id)
                                        <span class="material-icons-outlined text-sm">chevron_right</span>
                                    @endif
                                </a>
                            @endforeach
                        </nav>
                    </div>

                    <div class="mt-6 bg-blue-700 rounded-xl p-6 text-white text-center shadow-lg relative overflow-hidden group">
                        <div class="absolute top-0 right-0 -mt-2 -mr-2 w-16 h-16 bg-white opacity-10 rounded-full group-hover:scale-150 transition duration-500"></div>
                        <h4 class="font-bold text-lg mb-2">Butuh Bantuan?</h4>
                        <p class="text-xs text-blue-100 mb-4">Hubungi layanan PTSP kami untuk informasi lebih lanjut.</p>
                        <a href="#" class="inline-block px-4 py-2 bg-white text-blue-700 text-xs font-bold rounded shadow hover:bg-blue-50 transition">
                            Hubungi Kami
                        </a>
                    </div>
                </aside>

                <main class="w-full lg:w-3/4">
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8 md:p-12 min-h-[500px]">
                        
                        <div class="flex items-center gap-2 text-xs text-slate-400 mb-8 border-b border-slate-100 pb-4">
                            <span class="material-icons-outlined text-sm text-green-500">verified</span>
                            <span>Halaman Resmi</span>
                            <span class="mx-2">•</span>
                            <span class="material-icons-outlined text-sm">edit_calendar</span>
                            <span>Diperbarui: {{ $page->updated_at->translatedFormat('d F Y') }}</span>
                        </div>

                        <div class="prose prose-slate max-w-none prose-headings:text-slate-800 prose-a:text-green-600 hover:prose-a:text-green-700">
                            {!! $page->content !!}
                        </div>

                    </div>
                </main>

            </div>
        </div>
    </div>

</x-layout>