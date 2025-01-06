<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';
    protected static ?string $navigationGroup = 'Inventory';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('category_id')
                ->relationship('category', 'name')
                ->required()
                ->searchable(),
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(200),
            Forms\Components\Textarea::make('description')
                ->rows(3)
                ->maxLength(65535),
            Forms\Components\TextInput::make('price')
                ->required()
                ->numeric()
                ->prefix('Rp'),
            Forms\Components\TextInput::make('stock')
                ->required()
                ->numeric()
                ->default(0)
                ->minValue(0),
            Forms\Components\TextInput::make('sku')
                ->unique(ignoreRecord: true)
                ->maxLength(50),
            Forms\Components\Select::make('status')
                ->options([
                    'active' => 'Active',
                    'inactive' => 'Inactive',
                    'discontinued' => 'Discontinued',
                ])
                ->default('active')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('category.name')
                ->label('Category')
                ->searchable(),
            Tables\Columns\TextColumn::make('name')
                ->searchable(),
            Tables\Columns\TextColumn::make('price')
                ->money('IDR'),
            Tables\Columns\TextColumn::make('stock'),
            Tables\Columns\TextColumn::make('status')
                ->badge()
                ->colors([
                    'success' => 'active',
                    'warning' => 'inactive',
                    'danger' => 'discontinued',
                ]),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime(),
        ])->filters([
            //
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
