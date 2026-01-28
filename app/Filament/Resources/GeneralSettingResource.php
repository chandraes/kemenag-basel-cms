<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GeneralSettingResource\Pages;
use App\Filament\Resources\GeneralSettingResource\RelationManagers;
use App\Models\GeneralSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Textarea;

class GeneralSettingResource extends Resource
{
    protected static ?string $model = GeneralSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Section::make('Identitas Instansi')
                ->schema([
                    TextInput::make('site_name')
                        ->label('Nama Instansi')
                        ->required()
                        ->placeholder('Contoh: Kantor Kemenag Kab. Bangka Selatan'),
                    
                    TextInput::make('site_description')
                        ->label('Sub Judul / Deskripsi Singkat')
                        ->placeholder('Kabupaten Bangka Selatan'),

                    FileUpload::make('site_logo')
                        ->label('Logo Instansi')
                        ->image()
                        ->directory('settings') // Simpan di folder storage/app/public/settings
                        ->imageEditor(),
                ]),

            Section::make('Kontak & Jam Operasional')
                ->schema([
                    Grid::make(2)
                        ->schema([
                            TextInput::make('phone')
                                ->label('Nomor Telepon')
                                ->tel()
                                ->placeholder('0851-xxxx-xxxx'),
                                
                            TextInput::make('email')
                                ->label('Email Resmi')
                                ->email(),
                        ]),
                    
                    TextInput::make('operational_hours')
                        ->label('Jam Operasional')
                        ->placeholder('Senin - Kamis 07:30 - 16:00, Jumat 07:30 - 16:30')
                        ->columnSpanFull(),
                ]),
                Section::make('Media Sosial')
                    ->description('Masukkan link lengkap (https://...) ke profil medsos instansi.')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('facebook')
                                ->label('Facebook URL')
                                ->prefixIcon('heroicon-o-globe-alt') // Ikon globe sebagai penanda
                                ->placeholder('https://facebook.com/kemenagbasel')
                                ->url(), // Validasi format URL
                            
                            TextInput::make('instagram')
                                ->label('Instagram URL')
                                ->prefixIcon('heroicon-o-camera')
                                ->placeholder('https://instagram.com/kemenagbasel')
                                ->url(),

                            TextInput::make('youtube')
                                ->label('YouTube Channel URL')
                                ->prefixIcon('heroicon-o-play-circle')
                                ->placeholder('https://youtube.com/@kemenagbasel')
                                ->url(),

                            TextInput::make('tiktok')
                                ->label('TikTok URL')
                                ->prefixIcon('heroicon-o-musical-note') // Ikon nada
                                ->placeholder('https://tiktok.com/@kemenagbasel')
                                ->url(),
                    ]),
                ]),
                Forms\Components\Textarea::make('google_maps_embed')
                ->label('Google Maps Embed Code (HTML)')
                ->rows(5)
                ->placeholder('<iframe src="https://www.google.com/maps/embed?..." ...></iframe>')
                ->helperText('Caranya: Buka Google Maps -> Cari Kantor -> Klik Bagikan (Share) -> Sematkan Peta (Embed a map) -> Salin HTML -> Tempel di sini.')
                ->columnSpanFull(),
                Section::make('Banner Utama (Hero Section)')
                    ->description('Pengaturan tampilan layar utama jika TIDAK ADA berita headline yang dipilih.')
                    ->schema([
                        FileUpload::make('hero_bg_image')
                            ->label('Gambar Background')
                            ->image()
                            ->directory('settings/hero')
                            ->imageEditor()
                            ->columnSpanFull(),

                        TextInput::make('hero_title')
                            ->label('Judul Besar')
                            ->placeholder('Selamat Datang di Kemenag Basel')
                            ->required(),

                        Textarea::make('hero_description')
                            ->label('Deskripsi Singkat')
                            ->rows(3)
                            ->columnSpanFull(),

                        Grid::make(2)->schema([
                            TextInput::make('hero_cta_text')
                                ->label('Teks Tombol')
                                ->default('Lihat Profil')
                                ->placeholder('Contoh: Selengkapnya'),

                            TextInput::make('hero_cta_url')
                                ->label('Link Tombol (URL)')
                                ->placeholder('https://... atau #profil')
                                ->helperText('Kosongkan jika tidak ingin ada tombol.'),
                        ]),
                    ]),

                    Section::make('Sambutan Kepala Kantor')
                ->description('Informasi Kepala Kantor Kemenag dan kata sambutan.')
                ->schema([
                    Grid::make(2)->schema([
                        FileUpload::make('kakan_photo')
                            ->label('Foto Kepala Kantor')
                            ->image()
                            ->directory('settings/kakan') // Folder penyimpanan
                            ->avatar() // Mode avatar (bulat/kotak kecil di preview)
                            ->imageEditor()
                            ->columnSpan(1),
                        
                        TextInput::make('kakan_name')
                            ->label('Nama Lengkap & Gelar')
                            ->placeholder('Contoh: H. Jamaluddin, S.Ag., M.H.')
                            ->required()
                            ->columnSpan(1),
                    ]),

                    Textarea::make('kakan_message')
                        ->label('Isi Sambutan')
                        ->rows(5)
                        ->placeholder('Assalamu’alaikum Warahmatullahi Wabarakatuh...')
                        ->columnSpanFull(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
       return $table
            ->columns([
                Tables\Columns\TextColumn::make('site_name')->label('Nama Instansi'),
                Tables\Columns\TextColumn::make('phone')->label('Telepon'),
                Tables\Columns\TextColumn::make('email')->label('Email'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            // Hilangkan bulk actions agar tidak sengaja terhapus
            ->bulkActions([]);
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
            'index' => Pages\ListGeneralSettings::route('/'),
            'create' => Pages\CreateGeneralSetting::route('/create'),
            'edit' => Pages\EditGeneralSetting::route('/{record}/edit'),
        ];
    }
}
