<?php

namespace App\Filament\Resources\BeerResource\Pages;

use App\Filament\Resources\BeerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBeer extends EditRecord
{
    protected static string $resource = BeerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
