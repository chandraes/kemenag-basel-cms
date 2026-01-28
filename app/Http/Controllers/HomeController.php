<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Ambil 1 Berita Headline (Featured & Published)
        $heroPost = Post::published()
            ->featured()
            ->latest('published_at')
            ->first();

        // 2. Ambil Berita Terbaru (Kecuali yang sudah jadi headline)
        $latestPosts = Post::published()
            // Jika ada hero post, jangan ambil ID yang sama agar tidak duplikat
            ->when($heroPost, function ($query) use ($heroPost) {
                $query->where('id', '!=', $heroPost->id);
            })
            ->latest('published_at')
            ->paginate(9); // Tampilkan 9 berita per halaman

        return view('home', compact('heroPost', 'latestPosts'));
    }

    public function show(Post $post)
    {
        // Validasi: Jangan tampilkan jika status draft/jadwal belum lewat
        if ($post->status->value !== 'published' || $post->published_at > now()) {
            abort(404);
        }

        return view('posts.show', compact('post'));
    }
}