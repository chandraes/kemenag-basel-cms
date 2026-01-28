<x-layout>
    <x-slot:title>
        Hubungi Kami - {{ $settings->site_name ?? 'Kemenag Basel' }}
    </x-slot>

    <section class="relative bg-slate-900 py-20 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-green-600 blur-3xl opacity-20"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full bg-blue-600 blur-3xl opacity-20"></div>
            <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>
        </div>

        <div class="container mx-auto px-4 relative z-10 text-center">
            <span class="text-green-400 font-bold tracking-wider uppercase text-sm mb-2 block">Layanan Informasi</span>
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Hubungi Kami</h1>
            <p class="text-slate-400 max-w-xl mx-auto text-lg">
                Punya pertanyaan atau butuh bantuan? Tim kami siap melayani Anda melalui berbagai saluran komunikasi di bawah ini.
            </p>
        </div>
    </section>

    <section class="bg-slate-50 py-16">
        <div class="container mx-auto px-4">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 -mt-24 relative z-20">

                <div class="bg-white rounded-2xl shadow-xl p-8 lg:col-span-1 border border-slate-100 h-fit">
                    <h3 class="text-2xl font-bold text-slate-800 mb-6 flex items-center gap-2">
                        Info Kontak
                    </h3>

                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-full bg-green-50 text-green-600 flex items-center justify-center flex-shrink-0">
                                <span class="material-icons-outlined text-2xl">location_on</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900">Alamat Kantor</h4>
                                <p class="text-slate-600 text-sm leading-relaxed mt-1">
                                    {{ $settings->address ?? 'Alamat belum diatur di pengaturan.' }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0">
                                <span class="material-icons-outlined text-2xl">call</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900">Telepon / WhatsApp</h4>
                                <p class="text-slate-600 text-sm mt-1">
                                    {{ $settings->phone ?? '-' }}
                                </p>
                                <span class="text-xs text-slate-400">Senin - Jumat (Jam Kerja)</span>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-full bg-orange-50 text-orange-600 flex items-center justify-center flex-shrink-0">
                                <span class="material-icons-outlined text-2xl">mail</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900">Email Resmi</h4>
                                <p class="text-slate-600 text-sm mt-1">
                                    {{ $settings->email ?? '-' }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-full bg-purple-50 text-purple-600 flex items-center justify-center flex-shrink-0">
                                <span class="material-icons-outlined text-2xl">schedule</span>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-900">Jam Operasional</h4>
                                <p class="text-slate-600 text-sm mt-1">
                                    {{ $settings->operational_hours ?? 'Senin - Jumat: 07:30 - 16:00 WIB' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 pt-8 border-t border-slate-100">
                        <h4 class="font-bold text-slate-800 mb-4 text-sm uppercase tracking-wide">Media Sosial</h4>
                        <div class="flex gap-3">
                            @if($settings->facebook)
                                <a href="{{ $settings->facebook }}" target="_blank" class="w-10 h-10 rounded-lg bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition shadow-sm">
                                    <span class="material-icons-outlined">facebook</span>
                                </a>
                            @endif
                            @if($settings->instagram)
                                <a href="{{ $settings->instagram }}" target="_blank" class="w-10 h-10 rounded-lg bg-pink-600 text-white flex items-center justify-center hover:bg-pink-700 transition shadow-sm">
                                    <span class="material-icons-outlined">camera_alt</span>
                                </a>
                            @endif
                            @if($settings->youtube)
                                <a href="{{ $settings->youtube }}" target="_blank" class="w-10 h-10 rounded-lg bg-red-600 text-white flex items-center justify-center hover:bg-red-700 transition shadow-sm">
                                    <span class="material-icons-outlined">play_arrow</span>
                                </a>
                            @endif
                            @if($settings->tiktok)
                                <a href="{{ $settings->tiktok }}" target="_blank" class="w-10 h-10 rounded-lg bg-black text-white flex items-center justify-center hover:bg-gray-800 transition shadow-sm">
                                    <span class="material-icons-outlined">music_note</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-2 space-y-8">

                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-slate-100 p-2">
                        <div class="w-full h-96 bg-slate-200 rounded-xl overflow-hidden relative">
                            @if($settings->google_maps_embed)
                                <div class="w-full h-full [&_iframe]:w-full [&_iframe]:h-full [&_iframe]:border-0">
                                    {!! $settings->google_maps_embed !!}
                                </div>
                            @else
                                <div class="flex flex-col items-center justify-center h-full text-slate-400">
                                    <span class="material-icons-outlined text-6xl mb-2">map</span>
                                    <p>Peta belum disematkan di pengaturan.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-green-600 to-green-700 rounded-2xl shadow-lg p-8 text-white relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-6">
                        <div class="relative z-10">
                            <h3 class="text-2xl font-bold mb-2">Butuh Respon Cepat?</h3>
                            <p class="text-green-100 text-sm md:text-base max-w-md">
                                Silakan kirimkan surat elektronik (Email) langsung kepada kami atau datang ke kantor pelayanan.
                            </p>
                        </div>
                        <div class="relative z-10 flex-shrink-0">
                            <a href="mailto:{{ $settings->email }}" class="inline-flex items-center gap-2 bg-white text-green-700 px-6 py-3 rounded-xl font-bold shadow hover:bg-green-50 transition transform hover:-translate-y-1">
                                <span class="material-icons-outlined">send</span>
                                Kirim Email
                            </a>
                        </div>

                        <span class="material-icons-outlined absolute -right-6 -bottom-6 text-9xl text-white opacity-10 rotate-12">mark_email_unread</span>
                    </div>

                </div>

            </div>
        </div>
    </section>
</x-layout>
