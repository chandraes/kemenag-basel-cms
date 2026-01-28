<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Models\QuickLink;
use App\Models\Post;
use App\Models\Structural;
use App\Models\Facility;
use App\Models\Statistic;
use App\Models\Page;

Route::get('/', function () {
    return view('home', [
        // Ambil 1 Berita Headline (Featured = true DAN Status = published)
        'heroPost' => Post::where('status', 'published')
            ->where('is_featured', true)
            ->latest('published_at') // Urutkan berdasarkan tanggal tayang
            ->first(),

        // Ambil 6 Berita Terbaru (Status = published)
        'latestPosts' => Post::where('status', 'published')
            ->latest('published_at')
            ->paginate(6),

        // Ambil data Link Layanan (Quick Links)
        'quickLinks' => QuickLink::where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get() ,
        'structurals' => Structural::where('is_active', true)->orderBy('sort_order', 'asc')->get(),
        'facilities' => Facility::where('is_active', true)->orderBy('sort_order', 'asc')->get(),
        'statistics' => Statistic::orderBy('sort_order', 'asc')->get(),
    ]);
})->name('home');


// Route untuk menampilkan Halaman Profil Dinamis
Route::get('/profil/{page:slug}', function (Page $page) {
    
    // Kita juga kirim list semua page agar bisa bikin menu sidebar
    $allPages = Page::where('is_active', true)->get();
    
    return view('page.show', [
        'page' => $page,
        'allPages' => $allPages 
    ]);
})->name('page.show');

Route::get('/kontak', function () {
    return view('contact');
})->name('contact');

Route::get('/berita', function () {
    // Ambil berita status 'published', urutkan terbaru, 9 per halaman
    $posts = Post::where('status', 'published') 
        ->latest()
        ->paginate(9); 
        
    return view('post.index', compact('posts'));
})->name('post.index');
// Halaman Detail Berita (SEO Friendly dengan Slug)
Route::get('/berita/{post:slug}', function (Post $post) {
    // Ambil 5 berita terbaru lainnya untuk sidebar
    $recentPosts = Post::where('status', 'published')
        ->where('id', '!=', $post->id) // Jangan tampilkan berita yang sedang dibuka
        ->latest()
        ->take(5)
        ->get();

    return view('post.show', compact('post', 'recentPosts'));
})->name('post.show');
