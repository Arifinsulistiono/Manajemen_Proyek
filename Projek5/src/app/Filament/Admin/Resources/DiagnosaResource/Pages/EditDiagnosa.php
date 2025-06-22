<?php

namespace App\Filament\Admin\Resources\DiagnosaResource\Pages;

use App\Filament\Admin\Resources\DiagnosaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\Resep;
use Illuminate\Support\Facades\Log;

class EditDiagnosa extends EditRecord
{
    protected static string $resource = DiagnosaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $diagnosa = $this->record;

        // Jika status sudah diperiksa & resep belum dibuat
        if (
            $diagnosa->status === 'Sudah diperiksa' &&
            !Resep::where('diagnosa_id', $diagnosa->id)->exists()
        ) {
            Resep::create([
                'diagnosa_id' => $diagnosa->id,
                'obat_id' => null, // kosong dulu, nanti bisa diisi dokter
            ]);
        }
    }
}
