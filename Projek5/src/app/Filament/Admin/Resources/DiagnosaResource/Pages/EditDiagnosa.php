<?php

namespace App\Filament\Admin\Resources\DiagnosaResource\Pages;

use App\Filament\Admin\Resources\DiagnosaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDiagnosa extends EditRecord
{
    protected static string $resource = DiagnosaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
