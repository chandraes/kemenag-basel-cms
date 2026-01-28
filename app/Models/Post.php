<?php

namespace App\Models;

use App\Enums\PostStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'excerpt',
        'featured_image',
        'status',
        'is_featured',
        'published_at',
        'seo_title',
        'seo_description'
    ];

    // Konversi tipe data otomatis
    protected $casts = [
        'status' => PostStatus::class, // Langsung jadi Enum
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
    ];

    // Relasi ke User
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // SCOPE PENTING: Untuk Frontend
    // Agar di frontend Anda cukup panggil: Post::published()->get()
    // Tidak perlu nulis logic 'where status = published' berulang-ulang.
    public function scopePublished(Builder $query): void
    {
        $query->where('status', PostStatus::PUBLISHED)
              ->where('published_at', '<=', now()) // Cek jadwal tayang
              ->orderBy('published_at', 'desc');
    }
    
    // Scope untuk Berita Unggulan (Headline)
    public function scopeFeatured(Builder $query): void
    {
        $query->where('is_featured', true);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
