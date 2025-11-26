<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\DiagnosaResource\Pages;
use App\Models\Diagnosa;
use App\Models\Dokter;
use App\Models\Appointment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class DiagnosaResource extends Resource
{
    protected static ?string $model = Diagnosa::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationLabel = 'Diagnosa';
    protected static ?string $pluralModelLabel = 'Diagnosa';
    protected static ?string $modelLabel = 'Diagnosa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('appointment_id')
                    ->label('Nama Pasien')
                    ->relationship('appointment', 'nama') // ganti sesuai kolom nama pasien
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('dokter_id')
                    ->label('Dokter')
                    ->relationship('dokter', 'nama')
                    ->searchable()
                    ->required(),

                Forms\Components\Textarea::make('keluhan')
                    ->label('Keluhan')
                    ->columnSpanFull(),

                Forms\Components\Select::make('status')
                    ->options([
                        'Belum diperiksa' => 'Belum diperiksa',
                        'Sudah diperiksa' => 'Sudah diperiksa',
                    ])
                    ->label('Status')
                    ->native(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('appointment.nama') // ganti sesuai field pasien
                    ->label('Nama Pasien')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('dokter.nama')
                    ->label('Dokter')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('keluhan')
                    ->label('Keluhan')
                    ->limit(50)
                    ->wrap(),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'primary' => 'Belum Diperiksa',
                        'success' => 'Sudah Diperiksa',
                    ])
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDiagnosas::route('/'),
            'create' => Pages\CreateDiagnosa::route('/create'),
            'edit' => Pages\EditDiagnosa::route('/{record}/edit'),
        ];
    }
}