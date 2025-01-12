<?php

namespace App\Filament\Resources\DataUserResource\Pages;

use App\Filament\Resources\DataUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataUser extends EditRecord
{
    protected static string $resource = DataUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
