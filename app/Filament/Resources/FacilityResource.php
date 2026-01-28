<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FacilityResource\Pages;
use App\Filament\Resources\FacilityResource\RelationManagers;
use App\Models\Facility;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FacilityResource extends Resource
{
    protected static ?string $model = Facility::class;

    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Section::make('Data Fasilitas')
                ->schema([
                    Forms\Components\FileUpload::make('image')
                        ->label('Foto Fasilitas')
                        ->image()
                        ->directory('facilities')
                        ->imageEditor()
                        ->columnSpanFull()
                        ->required(),

                    Forms\Components\TextInput::make('name')
                        ->label('Nama Fasilitas')
                        ->required()
                        ->placeholder('Contoh: Ruang Pelayanan PTSP')
                        ->maxLength(255),

                    Forms\Components\Textarea::make('description')
                        ->label('Deskripsi Singkat')
                        ->rows(3)
                        ->placeholder('Contoh: Ruang tunggu nyaman ber-AC dengan akses Wi-Fi gratis.')
                        ->columnSpanFull(),

                    Forms\Components\Grid::make(2)->schema([
                        Forms\Components\TextInput::make('sort_order')
                            ->label('Urutan')
                            ->numeric()
                            ->default(0),
                        
                        Forms\Components\Toggle::make('is_active')
                            ->label('Tampilkan?')
                            ->default(true),
                    ]),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
       return $table
        ->columns([
            Tables\Columns\ImageColumn::make('image')->label('Foto'),
            Tables\Columns\TextColumn::make('name')->searchable()->label('Nama Fasilitas'),
            Tables\Columns\TextColumn::make('description')->limit(50)->label('Deskripsi'),
            Tables\Columns\ToggleColumn::make('is_active')->label('Aktif'),
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
            'index' => Pages\ListFacilities::route('/'),
            'create' => Pages\CreateFacility::route('/create'),
            'edit' => Pages\EditFacility::route('/{record}/edit'),
        ];
    }
}
