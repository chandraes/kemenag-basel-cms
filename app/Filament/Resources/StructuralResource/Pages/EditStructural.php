<?php

namespace App\Filament\Resources\StructuralResource\Pages;

use App\Filament\Resources\StructuralResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStructural extends EditRecord
{
    protected static string $resource = StructuralResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
