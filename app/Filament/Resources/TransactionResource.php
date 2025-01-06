<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\Select::make('order_id')
                ->relationship('order', 'order_number')
                ->required(),
            Forms\Components\TextInput::make('transaction_number')
                ->required()
                ->maxLength(50),
            Forms\Components\Select::make('payment_method')
                ->options([
                    'credit_card' => 'Credit Card',
                    'paypal' => 'PayPal',
                    'bank_transfer' => 'Bank Transfer',
                ])
                ->required(),
            Forms\Components\TextInput::make('amount')
                ->numeric()
                ->required()
                ->prefix('Rp'),
            Forms\Components\Select::make('status')
                ->options([
                    'pending' => 'Pending',
                    'failed' => 'Failed',
                    'success' => 'Success',
                    'refunded' => 'Refunded',
                ])
                ->required(),
            Forms\Components\DateTimePicker::make('payment_date')->required(),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('order.order_number')->label('Order'),
            Tables\Columns\TextColumn::make('transaction_number'),
            Tables\Columns\TextColumn::make('payment_method'),
            Tables\Columns\TextColumn::make('status')
                ->badge()
                ->colors([
                    'success' => 'paid',
                    'warning' => 'pending',
                    'danger' => 'failed',
                ]),
            Tables\Columns\TextColumn::make('amount')->money('IDR'),
            Tables\Columns\TextColumn::make('payment_date')->dateTime(),
        ])->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
        ])->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ])->emptyStateActions([
            Tables\Actions\CreateAction::make(),
        ]);
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
