<?php

namespace App\Filament\Resources\DataUserResource\Pages;

use App\Filament\Resources\DataUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDataUser extends ViewRecord
{
    protected static string $resource = DataUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
