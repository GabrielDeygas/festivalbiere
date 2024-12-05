<?php

namespace App\Filament\Resources\BeerResource\Pages;

use App\Filament\Resources\BeerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBeer extends CreateRecord
{
    protected static string $resource = BeerResource::class;
}
