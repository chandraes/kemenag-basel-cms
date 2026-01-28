<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str; // Import Str
use Filament\Forms\Set;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationLabel = 'Halaman Profil';

    protected static ?string $modelLabel = 'Halaman';

    protected static ?string $pluralModelLabel = 'Halaman';

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    public static function form(Form $form): Form
    {
       return $form
        ->schema([
            Forms\Components\Section::make('Konten Halaman')
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Judul Halaman')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),

                    Forms\Components\TextInput::make('slug')
                        ->label('URL Slug')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->helperText('Otomatis terisi dari judul. Contoh: visi-misi'),

                    Forms\Components\FileUpload::make('image')
                        ->label('Gambar Header (Opsional)')
                        ->image()
                        ->directory('pages')
                        ->columnSpanFull(),

                    // RICH TEXT EDITOR (PENTING UNTUK FORMAT VISI MISI)
                    Forms\Components\RichEditor::make('content')
                        ->label('Isi Halaman')
                        ->required()
                        ->columnSpanFull()
                        ->toolbarButtons([
                            'blockquote',
                            'bold',
                            'bulletList',
                            'h2',
                            'h3',
                            'italic',
                            'link',
                            'orderedList',
                            'redo',
                            'strike',
                            'underline',
                            'undo',
                        ]),

                    Forms\Components\Toggle::make('is_active')
                        ->label('Publikasikan')
                        ->default(true),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->label('Judul'),
                Tables\Columns\TextColumn::make('slug')->label('URL Slug'),
                Tables\Columns\IconColumn::make('is_active')->boolean()->label('Aktif'),
                Tables\Columns\TextColumn::make('updated_at')->date()->label('Terakhir Update'),
            ])
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
