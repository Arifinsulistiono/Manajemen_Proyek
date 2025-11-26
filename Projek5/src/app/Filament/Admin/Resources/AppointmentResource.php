<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AppointmentResource\Pages;
use App\Models\Appointment;
use App\Models\Diagnosa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AppointmentResource extends Resource
{
    protected static ?string $model = Appointment::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'Appointment';
    protected static ?string $pluralModelLabel = 'Appointment';
    protected static ?string $modelLabel = 'Appointment';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('nama')
            ->label('Nama Pasien')
            ->required()
            ->maxLength(255),
            Forms\Components\TextInput::make('email')
            ->label('Email')
            ->email()
            ->required()
            ->maxLength(255),
            Forms\Components\TextInput::make('mobile')
            ->label('Kontak')
            ->required()
            ->maxLength(255),
            Forms\Components\DatePicker::make('date')
            ->label('Tanggal')
            ->required(),
            Forms\Components\TextInput::make('time')
            ->label('Jam')
            ->required()
            ->maxLength(255),
            Forms\Components\Select::make('dokter_id')
                ->relationship('dokter', 'nama')
                ->required(),
            Forms\Components\Select::make('status')
                ->options([
                    'pending' => 'Pending',
                    'approved' => 'Approved',
                    'rejected' => 'Rejected',
                ])
                ->default('pending')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
                Tables\Columns\TextColumn::make('nama')
                ->label('Nama Pasien')
                ->searchable(),
                Tables\Columns\TextColumn::make('email')
                ->label('Email')
                ->searchable(),
                Tables\Columns\TextColumn::make('mobile')
                ->label('Kontak')
                ->searchable(),
                Tables\Columns\TextColumn::make('date')
                ->label('Tanggal')
                ->date()
                ->sortable(),
                Tables\Columns\TextColumn::make('time')
                ->label('Jam')
                ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'gray' => 'pending',
                        'success' => 'approved',
                        'danger' => 'rejected',
                    ])
                    ->sortable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

            Tables\Actions\Action::make('approve')
                ->label('Approve')
                ->color('success')
                ->icon('heroicon-o-check-circle')
                ->visible(fn ($record) => $record->status === 'pending')
                ->action(function ($record) {
                    $record->update(['status' => 'approved']);

                    // Kirim email approved
                    \Mail::to($record->email)->send(new \App\Mail\AppointmentApprovedMail($record));
                })
                ->requiresConfirmation()
                ->successNotificationTitle('Appointment disetujui dan email dikirim.'),

            Tables\Actions\Action::make('reject')
                ->label('Reject')
                ->color('danger')
                ->icon('heroicon-o-x-circle')
                ->visible(fn ($record) => $record->status === 'pending')
                ->action(function ($record) {
                    $record->update(['status' => 'rejected']);

                    // Kirim email rejected
                    \Mail::to($record->email)->send(new \App\Mail\AppointmentRejectedMail($record));
                })
                ->requiresConfirmation()
                ->successNotificationTitle('Appointment ditolak dan email dikirim.'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAppointments::route('/'),
            'create' => Pages\CreateAppointment::route('/create'),
            'edit' => Pages\EditAppointment::route('/{record}/edit'),
        ];
    }
}
