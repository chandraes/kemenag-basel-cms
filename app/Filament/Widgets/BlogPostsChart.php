<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class BlogPostsChart extends ChartWidget
{
    protected static ?string $heading = 'Statistik Berita (Tahun Ini)';
    protected static ?int $sort = 2; // Urutan tampilan

    protected function getData(): array
    {
        // Logika sederhana mengambil data per bulan (Jan-Des)
        $data = [];
        $months = [];
        
        for ($i = 1; $i <= 12; $i++) {
            $months[] = Carbon::create()->month($i)->format('M');
            $data[] = Post::whereYear('created_at', date('Y'))
                        ->whereMonth('created_at', $i)
                        ->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Berita',
                    'data' => $data,
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#36A2EB',
                ],
            ],
            'labels' => $months,
        ];
    }

    protected function getType(): string
    {
        return 'line'; // Bisa diganti 'bar', 'line', 'pie'
    }
}