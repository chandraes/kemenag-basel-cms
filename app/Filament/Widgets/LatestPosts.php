<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestPosts extends BaseWidget
{
    protected static ?int $sort = 3; // Tampil paling bawah
    protected int | string | array $columnSpan = 'full'; // Agar lebar penuh

    public function table(Table $table): Table
    {
        return $table
            ->query(
                // Ambil 5 berita terakhir
                Post::latest()->limit(5)
            )
            ->columns([
                Tables\Columns\ImageColumn::make('featured_image')
                    ->label('Gambar')
                    ->circular(),
                    
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->limit(50)
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Penulis')
                    ->color('gray'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->paginated(false); // Matikan pagination karena cuma widget
    }
}