<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Berita', Post::count())
                ->description('Semua berita yang diterbitkan')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]), // Hiasan grafik kecil (dummy)

            Stat::make('Total Pengguna', User::count())
                ->description('Admin & Penulis')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),

            Stat::make('Berita Hari Ini', Post::whereDate('created_at', today())->count())
                ->description('Postingan baru hari ini')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('warning'),
        ];
    }
}