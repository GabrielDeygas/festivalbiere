<?php

namespace App\Filament\Resources\BeerResource\Pages;

use App\Filament\Resources\BeerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBeers extends ListRecords
{
    protected static string $resource = BeerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
