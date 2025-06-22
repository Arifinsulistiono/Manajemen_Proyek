<?php

namespace App\Filament\Admin\Resources\AppointmentResource\Pages;

use App\Filament\Admin\Resources\AppointmentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\Diagnosa;

class EditAppointment extends EditRecord
{
    protected static string $resource = AppointmentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        $appointment = $this->record;

        if (
            $appointment->status === 'approved' &&
            !Diagnosa::where('appointment_id', $appointment->id)->exists()
        ) {
            Diagnosa::create([
                'appointment_id' => $appointment->id,
                'nama_pasien' => $appointment->nama,
                'dokter_id' => $appointment->dokter_id,
                'status' => 'Belum Diperiksa',
            ]);
        }
    }
}
