<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('order_number')
                ->required()
                ->maxLength(50),
            Forms\Components\TextInput::make('customer_name')
                ->required()
                ->maxLength(100),
            Forms\Components\TextInput::make('customer_email')
                ->email()
                ->required()
                ->maxLength(100),
            Forms\Components\TextInput::make('customer_phone')
                ->tel()
                ->required()
                ->maxLength(15),
            Forms\Components\Textarea::make('shipping_address')
                ->required()
                ->maxLength(65535),
            Forms\Components\Select::make('order_status')
                ->options([
                    'pending' => 'Pending',
                    'processing' => 'Processing',
                    'completed' => 'Completed',
                    'cancelled' => 'Cancelled',
                ])
                ->default('pending')
                ->required(),
            Forms\Components\TextInput::make('total_amount')
                ->numeric()
                ->required()
                ->prefix('Rp'),
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('order_number')->searchable(),
            Tables\Columns\TextColumn::make('customer_name')->searchable(),
            Tables\Columns\TextColumn::make('order_status')
                ->badge()
                ->colors([
                    'success' => 'completed',
                    'warning' => 'processing',
                    'danger' => 'cancelled',
                ]),
            Tables\Columns\TextColumn::make('total_amount')->money('IDR'),
            Tables\Columns\TextColumn::make('created_at')->dateTime(),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
