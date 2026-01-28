<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StructuralResource\Pages;
use App\Filament\Resources\StructuralResource\RelationManagers;
use App\Models\Structural;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StructuralResource extends Resource
{
    protected static ?string $model = Structural::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
     return $form
        ->schema([
            Forms\Components\Section::make('Identitas Pejabat')
                ->schema([
                    Forms\Components\FileUpload::make('photo')
                        ->label('Foto Pejabat')
                        ->image()
                        ->avatar() // Mode bulat/avatar
                        ->imageEditor()
                        ->directory('structurals')
                        ->columnSpanFull()
                        ->helperText('Disarankan rasio 1:1 (Persegi)'),

                    Forms\Components\TextInput::make('name')
                        ->label('Nama Lengkap')
                        ->required()
                        ->placeholder('Contoh: H. Ahmad, S.Pd.I'),

                    Forms\Components\TextInput::make('position')
                        ->label('Jabatan')
                        ->required()
                        ->placeholder('Contoh: Kasubbag Tata Usaha'),

                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(10)
                            ->helperText('Angka lebih kecil tampil lebih dulu'),
                        
                        Forms\Components\Toggle::make('is_active')
                            ->label('Tampilkan di Website?')
                            ->default(true)
                            ->inline(false),
                    ]),
                ])->columns(2), // Layout 2 kolom
        ]);
    }

    public static function table(Table $table): Table
    {
      return $table
        ->columns([
            Tables\Columns\ImageColumn::make('photo')->circular()->label('Foto'),
            Tables\Columns\TextColumn::make('name')->searchable()->sortable()->label('Nama'),
            Tables\Columns\TextColumn::make('position')->searchable()->label('Jabatan'),
            Tables\Columns\TextColumn::make('sort_order')->sortable()->label('Urutan'),
            Tables\Columns\ToggleColumn::make('is_active')->label('Aktif'),
        ])
        ->defaultSort('sort_order', 'asc') // Urutkan berdasarkan sort_order
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
            'index' => Pages\ListStructurals::route('/'),
            'create' => Pages\CreateStructural::route('/create'),
            'edit' => Pages\EditStructural::route('/{record}/edit'),
        ];
    }
}
