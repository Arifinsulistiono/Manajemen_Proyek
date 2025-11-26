<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\TransactionResource\Pages;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Str;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationLabel = 'Transaksi';
    protected static ?string $pluralModelLabel = 'Transaksi';
    protected static ?string $modelLabel = 'Transaksi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('appointment_id')
                    ->label('Pasien')
                    ->relationship('appointment', 'nama')
                    ->searchable()
                    ->live()
                    ->required()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $appointment = \App\Models\Appointment::find($state);
                        $jasa = $appointment->dokter?->harga_jasa ?? 0;
                        $obat = $appointment->diagnosa?->resep?->obats?->sum('harga') ?? 0;
                        $total = $jasa + $obat;

                        $set('amount', $total);
                        $set('invoice_code', 'INV-' . now()->format('YmdHis') . strtoupper(Str::random(4)));
                    }),

                Forms\Components\TextInput::make('invoice_code')
                    ->label('Kode Invoice (Otomatis)')
                    ->disabled()
                    ->dehydrated()
                    ->required(),

                Forms\Components\TextInput::make('amount')
                    ->label('Total Tagihan')
                    ->numeric()
                    ->disabled()
                    ->dehydrated()
                    ->required(),

                Forms\Components\Select::make('status')
                    ->label('Status Pembayaran')
                    ->options([
                        'Belum Lunas' => 'Belum Lunas',
                        'Lunas' => 'Lunas',
                    ])
                    ->required()
                    ->default('Belum Lunas'),

                Forms\Components\Select::make('payment_method')
                    ->label('Metode Pembayaran')
                    ->options([
                        'BCA' => 'Transfer BCA',
                        'MANDIRI' => 'Transfer Mandiri',
                        'DANA' => 'Dana',
                    ])
                    ->required()
                    ->searchable(),

                Forms\Components\FileUpload::make('bukti_pembayaran')
                    ->label('Bukti Pembayaran')
                    ->directory('uploads') // ini akan menyimpan ke public/uploads
                    ->disk('local')        // default ke public_path
                    ->visibility('public')
                    ->image()
                    ->preserveFilenames()
                    ->enableDownload()
                    ->enableOpen(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pasien_nama')
                    ->label('Pasien')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('harga_jasa_dokter')
                    ->label('Jasa Dokter')
                    ->money('IDR', true),

                Tables\Columns\TextColumn::make('obat_list')
                    ->label('Obat')
                    ->wrap(),

                Tables\Columns\TextColumn::make('total_harga_obat')
                    ->label('Harga Obat')
                    ->money('IDR', true),

                Tables\Columns\TextColumn::make('total_tagihan')
                    ->label('Total Tagihan')
                    ->money('IDR', true),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'danger' => 'Belum Lunas',
                        'success' => 'Lunas',
                    ]),

                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Metode Pembayaran')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\ImageColumn::make('bukti_pembayaran')
                    ->label('Bukti')
                    ->disk('public')
                    ->height(80),
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}