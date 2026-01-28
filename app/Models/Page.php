<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $guarded = [];
    
    // Agar bisa mencari berdasarkan slug, bukan ID
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
