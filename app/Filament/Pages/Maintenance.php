<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Artisan;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class Maintenance extends Page
{

    // Icon menu di sidebar (bisa diganti sesuai selera)
    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    // Label menu
    protected static ?string $navigationLabel = 'System Tools';
    
    // Judul Halaman
    protected static ?string $title = 'Perawatan Sistem';

    // Urutan menu (paling bawah biar tidak mengganggu)
    protected static ?int $navigationSort = 99;

    // File view (default dari generate)
    protected static string $view = 'filament.pages.maintenance';

    public static function canAccess(): bool
    {
        // Hanya tampil jika user punya permission 'view_maintenance'
        // Permission ini nanti kita buat manual/otomatis
        return Auth::user()->can('page_Maintenance');
    }
    // LOGIKA TOMBOL ADA DI SINI
    protected function getHeaderActions(): array
    {
        return [
            // TOMBOL 1: FIX STORAGE LINK
            Action::make('linkStorage')
                ->label('Perbaiki Gambar (Storage Link)')
                ->color('primary') // Warna Biru
                ->icon('heroicon-o-link')
                ->requiresConfirmation() // Muncul popup konfirmasi "Yakin?"
                ->modalHeading('Perbaiki Tampilan Gambar?')
                ->modalDescription('Jalankan ini jika gambar berita tidak muncul (broken image).')
                ->modalSubmitActionLabel('Ya, Perbaiki')
                ->action(function () {
                    try {
                        Artisan::call('storage:link');
                        Notification::make()
                            ->title('Berhasil!')
                            ->body('Storage link telah dibuat ulang.')
                            ->success()
                            ->send();
                    } catch (\Exception $e) {
                        Notification::make()
                            ->title('Gagal')
                            ->body('Error: ' . $e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),

            // TOMBOL 2: CLEAR CACHE (Penting untuk Cpanel)
            Action::make('clearCache')
                ->label('Bersihkan Cache')
                ->color('warning') // Warna Kuning
                ->icon('heroicon-o-trash')
                ->requiresConfirmation()
                ->action(function () {
                    try {
                        Artisan::call('optimize:clear');
                        Notification::make()
                            ->title('Cache Bersih!')
                            ->body('Sistem telah disegarkan.')
                            ->success()
                            ->send();
                    } catch (\Exception $e) {
                        Notification::make()
                            ->title('Gagal')
                            ->body('Error: ' . $e->getMessage())
                            ->danger()
                            ->send();
                    }
                }),
        ];
    }
}