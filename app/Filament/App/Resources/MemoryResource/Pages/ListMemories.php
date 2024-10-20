<?php

namespace App\Filament\App\Resources\MemoryResource\Pages;

use App\Filament\App\Resources\MemoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMemories extends ListRecords
{
    protected static string $resource = MemoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
