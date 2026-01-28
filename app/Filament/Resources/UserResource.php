<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    // Ikon User
    protected static ?string $navigationIcon = 'heroicon-o-users';
    
    // Group Menu
    protected static ?string $navigationGroup = 'Manajemen User';

   public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Akun')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),
                        
                        // --- INPUT USERNAME (WAJIB) ---
                        Forms\Components\TextInput::make('username')
                            ->label('Username')
                            ->required()
                            ->unique(ignoreRecord: true) // Cek unik agar tidak kembar
                            ->maxLength(255),
                        
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $context): bool => $context === 'create')
                            ->label('Password'),

                        // Pilihan Role
                        Forms\Components\Select::make('roles')
                            ->relationship('roles', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable()
                            ->label('Role / Jabatan'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->label('Nama'),
                
                // --- MENAMPILKAN KOLOM USERNAME ---
                Tables\Columns\TextColumn::make('username')
                    ->searchable()
                    ->icon('heroicon-o-user-circle') // Ikon pemanis
                    ->label('Username'),

                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->icon('heroicon-o-envelope'),
                
                Tables\Columns\TextColumn::make('roles.name')
                    ->badge()
                    ->label('Role')
                    ->color(fn (string $state): string => match ($state) {
                        'super_admin' => 'danger',
                        'panel_user' => 'success',
                        default => 'primary',
                    }),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}