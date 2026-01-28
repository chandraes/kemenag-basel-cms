<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Enums\PostStatus;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Toggle;
use Illuminate\Support\Str;
use Filament\Forms\Set;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Get;


class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-up-on-square-stack';
    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            // LAYOUT GRID: Kiri (Konten) 2 kolom, Kanan (Meta) 1 kolom
            Grid::make(3)->schema([
                
                // --- BAGIAN KIRI (Konten Utama) ---
                Section::make('Konten Berita')
                    ->columnSpan(2) // Makan 2 kolom
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul Berita')
                            ->required()
                            ->maxLength(255)
                            // Live generate SLUG saat ngetik Judul
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                                if (($get('slug') ?? '') !== Str::slug($old)) {
                                    return;
                                }
                                $set('slug', Str::slug($state));
                            }),

                        TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true) // Cek unik, kecuali punya diri sendiri (saat edit)
                            ->maxLength(255)
                            ->readOnly(), // User biasa jangan ubah slug manual biar gak rusak SEO

                        RichEditor::make('content')
                            ->label('Isi Berita')
                            ->required()
                            ->fileAttachmentsDirectory('posts/content-images') // Simpan gambar konten rapi
                            ->columnSpanFull(),
                            
                        TextInput::make('excerpt')
                            ->label('Ringkasan Singkat')
                            ->helperText('Ditampilkan di halaman depan sebagai preview.')
                            ->maxLength(500),
                    ]),

                // --- BAGIAN KANAN (Meta Data & Publish) ---
                Section::make('Publikasi & Gambar')
                    ->columnSpan(1) // Makan 1 kolom
                    ->schema([
                        FileUpload::make('featured_image')
                            ->label('Gambar Utama')
                            ->image()
                            ->directory('posts/thumbnails') // Folder penyimpanan
                            ->imageEditor(), // Fitur crop bawaan filament

                        Select::make('status')
                            ->label('Status')
                            ->options(PostStatus::class)
                            ->default(PostStatus::DRAFT)
                            ->required()
                            // LOGIKA ROLE:
                            // Jika bukan admin, disable opsi 'Published'. 
                            // User biasa cuma bisa Draft atau Pending.
                            ->disableOptionWhen(fn (string $value): bool => 
                                $value === PostStatus::PUBLISHED->value && !auth()->user()->isAdmin() 
                                // ^^^ Pastikan User model punya method isAdmin() nanti
                            ),

                        DateTimePicker::make('published_at')
                            ->label('Jadwal Tayang')
                            ->default(now()),

                        Toggle::make('is_featured')
                            ->label('Jadikan Headline')
                            ->onColor('success')
                            ->offColor('danger')
                            // Hanya admin yang bisa set headline
                            ->visible(fn () => auth()->user()->isAdmin()), // Sembunyikan kalau bukan admin

                        // Hidden field author (otomatis isi ID user login saat create)
                        Select::make('user_id')
                            ->relationship('author', 'name')
                            ->default(auth()->id())
                            ->disabled() // Tidak bisa diubah
                            ->dehydrated(), // Tetap dikirim ke database
                    ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {

       return $table
        ->columns([
            ImageColumn::make('featured_image')
                ->label('Cover')
                ->circular(), // Tampil bulat kecil
            
            TextColumn::make('title')
                ->label('Judul')
                ->searchable() // Bisa dicari
                ->sortable()
                ->limit(30), // Potong kalau kepanjangan

            TextColumn::make('author.name')
                ->label('Penulis')
                ->sortable(),

            TextColumn::make('status')
                ->badge(), // Tampil sebagai badge warna-warni (dari Enum)

            IconColumn::make('is_featured')
                ->label('Headline')
                ->boolean(),

            TextColumn::make('published_at')
                ->label('Tayang')
                ->dateTime('d M Y H:i')
                ->sortable(),
        ])
        ->defaultSort('created_at', 'desc') // Urutkan terbaru paling atas
        ->filters([
            SelectFilter::make('status')
            ->options([
                'draft' => 'Draft (Konsep)',
                'reviewing' => 'Menunggu Review',
                'published' => 'Terbit',
                'rejected' => 'Ditolak',
            ]),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
