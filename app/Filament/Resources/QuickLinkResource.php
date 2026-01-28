<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuickLinkResource\Pages;
use App\Filament\Resources\QuickLinkResource\RelationManagers;
use App\Models\QuickLink;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\ToggleColumn;

class QuickLinkResource extends Resource
{
    protected static ?string $model = QuickLink::class;

    protected static ?string $navigationIcon = 'heroicon-o-link';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('title')
                ->label('Nama Layanan')
                ->required()
                ->placeholder('Contoh: PTSP Online'),

            TextInput::make('url')
                ->label('Link URL')
                ->url()
                ->required()
                ->placeholder('https://...'),

            TextInput::make('icon_name')
                ->label('Nama Icon (Material Icons)')
                ->required()
                ->placeholder('school')
                ->helperText('Cari nama icon di: fonts.google.com/icons. Contoh: school, menu_book, g_translate'),

            ColorPicker::make('color')
                ->label('Warna Background Icon')
                ->required(),

            Select::make('target')
                ->label('Buka Link di...')
                ->options([
                    '_self' => 'Tab Saat Ini',
                    '_blank' => 'Tab Baru (Untuk link luar)',
                ])
                ->default('_self'),

            TextInput::make('sort_order')
                ->numeric()
                ->label('Urutan Tampil')
                ->default(0),

            Toggle::make('is_active')
                ->label('Aktifkan?')
                ->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
       return $table
            ->columns([
                TextColumn::make('title')->label('Layanan')->searchable(),
                TextColumn::make('icon_name')->label('Icon'),
                ColorColumn::make('color')->label('Warna'),
                TextColumn::make('url')->label('URL')->limit(30),
                TextColumn::make('sort_order')->label('Urutan')->sortable(),
                ToggleColumn::make('is_active')->label('Aktif'),
            ])
            ->defaultSort('sort_order', 'asc')
            ->filters([])
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
            'index' => Pages\ListQuickLinks::route('/'),
            'create' => Pages\CreateQuickLink::route('/create'),
            'edit' => Pages\EditQuickLink::route('/{record}/edit'),
        ];
    }
}
