<?php

namespace App\Filament\Resources\VentasResource\Pages;

use App\Filament\Resources\VentasResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateVentas extends CreateRecord
{
    protected static string $resource = VentasResource::class;

    protected function getRedirectUrl():String
    {
        return $this->getResource()::getUrl('index');
    }
}
