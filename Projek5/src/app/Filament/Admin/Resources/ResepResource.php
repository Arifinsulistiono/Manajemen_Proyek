<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ResepResource\Pages;
use App\Models\Resep;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ResepResource extends Resource
{
    protected static ?string $model = Resep::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Resep Obat';
    protected static ?string $pluralModelLabel = 'Resep';
    protected static ?string $modelLabel = 'Resep';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('diagnosa_id')
                    ->label('Pasien')
                    ->relationship('diagnosa', 'id')
                    ->getOptionLabelFromRecordUsing(function ($record) {
                        return $record->appointment->nama . ' - ' . $record->keluhan;
                    })
                    ->searchable()
                    ->required(),

                Forms\Components\MultiSelect::make('obats')
                    ->label('Obat-obatan')
                    ->relationship('obats', 'nama') // relasi many-to-many
                    ->searchable()
                    ->required()
                    ->placeholder('Pilih satu atau lebih obat'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('diagnosa.appointment.nama')
                    ->label('Nama Pasien')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('diagnosa.keluhan')
                    ->label('Keluhan')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('obats')
                    ->label('Obat-obatan')
                    ->formatStateUsing(fn ($record) => $record->obats->pluck('nama')->implode(', ') ?: '-')
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
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReseps::route('/'),
            'create' => Pages\CreateResep::route('/create'),
            'edit' => Pages\EditResep::route('/{record}/edit'),
        ];
    }
}