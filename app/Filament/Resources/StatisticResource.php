<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StatisticResource\Pages;
use App\Filament\Resources\StatisticResource\RelationManagers;
use App\Models\Statistic;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\HtmlString;

class StatisticResource extends Resource
{
    protected static ?string $model = Statistic::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    public static function form(Form $form): Form
    {
       return $form
        ->schema([
            Forms\Components\Section::make('Data Statistik')
                ->schema([
                    Forms\Components\TextInput::make('label')
                        ->label('Judul Data')
                        ->placeholder('Contoh: Pegawai ASN')
                        ->required(),

                    Forms\Components\TextInput::make('value')
                        ->label('Angka / Nilai')
                        ->placeholder('Contoh: 1,250')
                        ->required(),

                    // DROPDOWN ICON DENGAN LIVE PREVIEW
                    Forms\Components\Select::make('icon')
                        ->label('Cari Icon (Google Material)')
                        ->searchable() // Bisa diketik untuk mencari
                        ->preload() // Memuat opsi agar pencarian cepat
                        ->live() // Aktifkan mode live update untuk preview
                        ->helperText(fn ($state) => $state 
                            ? new HtmlString('<div class="flex items-center gap-2 mt-2"><span class="material-icons-outlined text-3xl text-blue-600">'.$state.'</span> <span class="text-xs text-gray-500">Preview Icon</span></div>') 
                            : 'Pilih icon di atas untuk melihat preview')
                        ->options([
                            'KANTOR & BANGUNAN' => [
                                'apartment' => 'Gedung / Kantor',
                                'school' => 'Sekolah / Madrasah',
                                'mosque' => 'Masjid',
                                'church' => 'Gereja',
                                'home' => 'Rumah',
                                'location_city' => 'Kota / Perkotaan',
                                'domain' => 'Institusi / Web',
                                'meeting_room' => 'Ruang Rapat',
                                'store' => 'Toko / Koperasi',
                            ],
                            'ORANG & JABATAN' => [
                                'groups' => 'Kelompok / Masyarakat',
                                'person' => 'Seseorang',
                                'face' => 'Wajah / Profil',
                                'engineering' => 'Teknisi / Pekerja',
                                'school' => 'Siswa / Guru',
                                'child_care' => 'Anak-anak',
                                'diversity_3' => 'Kerukunan',
                                'psychology' => 'Mental / Penyuluhan',
                                'supervisor_account' => 'Pejabat / Admin',
                            ],
                            'DOKUMEN & DATA' => [
                                'description' => 'Dokumen / File',
                                'article' => 'Artikel / Berita',
                                'assignment' => 'Tugas / Laporan',
                                'menu_book' => 'Buku / Kitab',
                                'library_books' => 'Perpustakaan',
                                'folder' => 'Folder Arsip',
                                'bar_chart' => 'Grafik Batang',
                                'pie_chart' => 'Diagram Lingkaran',
                                'show_chart' => 'Tren Naik',
                                'table_view' => 'Tabel Data',
                            ],
                            'LAYANAN & UMUM' => [
                                'verified' => 'Terverifikasi / Halal',
                                'gavel' => 'Hukum / Palu Hakim',
                                'balance' => 'Neraca / Keadilan',
                                'handshake' => 'Kerjasama / Salaman',
                                'volunteer_activism' => 'Donasi / Kepedulian',
                                'public' => 'Global / Bola Dunia',
                                'language' => 'Bahasa',
                                'search' => 'Pencarian',
                                'check_circle' => 'Sukses / Centang',
                                'info' => 'Informasi',
                                'help' => 'Bantuan',
                                'call' => 'Telepon',
                                'mail' => 'Email / Surat',
                            ],
                            'KEUANGAN & ASET' => [
                                'attach_money' => 'Uang / Dolar',
                                'savings' => 'Tabungan / Zakat',
                                'account_balance_wallet' => 'Dompet',
                                'payments' => 'Pembayaran',
                                'credit_card' => 'Kartu Kredit',
                                'trending_up' => 'Investasi Naik',
                            ],
                            'TRANSPORTASI & PERJALANAN' => [
                                'flight_takeoff' => 'Penerbangan / Haji',
                                'directions_car' => 'Mobil / Kendaraan',
                                'local_shipping' => 'Truk / Logistik',
                                'map' => 'Peta',
                                'place' => 'Lokasi / Pin',
                            ],
                        ])
                        ->required(),

                    Forms\Components\Select::make('color')
                        ->label('Warna Aksen')
                        ->options([
                            'blue' => 'Biru (Standar)',
                            'green' => 'Hijau (Agamis)',
                            'red' => 'Merah (Penting)',
                            'yellow' => 'Kuning (Terang)',
                        ])
                        ->default('blue'),

                    Forms\Components\TextInput::make('sort_order')
                        ->label('Urutan')
                        ->numeric()
                        ->default(0),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
       return $table
        ->columns([
            Tables\Columns\TextColumn::make('label')->label('Judul'),
            Tables\Columns\TextColumn::make('value')->label('Nilai')->weight('bold'),
            Tables\Columns\TextColumn::make('icon')->label('Kode Icon'),
            Tables\Columns\TextColumn::make('color')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'blue' => 'info',
                    'green' => 'success',
                    'red' => 'danger',
                    'yellow' => 'warning',
                    default => 'gray',
                }),
        ])
        ->defaultSort('sort_order', 'asc')
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStatistics::route('/'),
            'create' => Pages\CreateStatistic::route('/create'),
            'edit' => Pages\EditStatistic::route('/{record}/edit'),
        ];
    }
}
