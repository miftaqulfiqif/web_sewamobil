<?php

namespace App\Filament\Resources\DataUserResource\Pages;

use App\Filament\Resources\DataUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDataUsers extends ListRecords
{
    protected static string $resource = DataUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
