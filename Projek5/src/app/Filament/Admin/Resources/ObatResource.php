<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ObatResource\Pages;
use App\Models\Obat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ObatResource extends Resource
{
    protected static ?string $model = Obat::class;

    protected static ?string $navigationIcon = 'heroicon-o-beaker';
    protected static ?string $navigationLabel = 'Obat';
    protected static ?string $pluralModelLabel = 'Data Obat';
    protected static ?string $modelLabel = 'Obat';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->label('Nama Obat')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('harga')
                    ->label('Harga')
                    ->required()
                    ->numeric(),

                Forms\Components\Select::make('kategori')
                    ->label('Kategori')
                    ->required()
                    ->searchable()
                    ->options([
                        'Antipiretik & Analgesik' => 'Antipiretik & Analgesik',
                        'Antibiotik' => 'Antibiotik',
                        'Obat Batuk dan Flu' => 'Obat Batuk dan Flu',
                        'Antihistamin' => 'Antihistamin',
                        'Obat Lambung' => 'Obat Lambung',
                        'Vitamin' => 'Vitamin',
                        'Anti Mual & Mabuk' => 'Anti Mual & Mabuk',
                        'Obat Diare' => 'Obat Diare',
                        'Anti Inflamasi & Alergi' => 'Anti Inflamasi & Alergi',
                        'Antiseptik' => 'Antiseptik',
                        'Obat Luar & Herbal' => 'Obat Luar & Herbal',
                        'Obat Tenggorokan' => 'Obat Tenggorokan',
                    ]),

                Forms\Components\Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->rows(3)
                    ->maxLength(500),

                Forms\Components\Select::make('status')
                    ->label('Aturan Minum')
                    ->required()
                    ->options([
                        'Sebelum Makan' => 'Sebelum Makan',
                        'Sesudah Makan' => 'Sesudah Makan',
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Obat')
                    ->searchable(),

                Tables\Columns\TextColumn::make('harga')
                    ->label('Harga')
                    ->money('IDR', true)
                    ->sortable(),

                Tables\Columns\TextColumn::make('kategori')
                    ->label('Kategori')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('deskripsi')
                    ->label('Deskripsi')
                    ->limit(50),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Aturan Minum')
                    ->colors([
                        'primary' => 'Sebelum Makan',
                        'success' => 'Sesudah Makan',
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
            'index' => Pages\ListObats::route('/'),
            'create' => Pages\CreateObat::route('/create'),
            'edit' => Pages\EditObat::route('/{record}/edit'),
        ];
    }
}