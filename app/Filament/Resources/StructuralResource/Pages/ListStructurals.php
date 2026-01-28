<?php

namespace App\Filament\Resources\StructuralResource\Pages;

use App\Filament\Resources\StructuralResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStructurals extends ListRecords
{
    protected static string $resource = StructuralResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
