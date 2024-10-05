<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VentasResource\Pages;
use App\Filament\Resources\VentasResource\RelationManagers;
use App\Models\Ventas;
use App\Models\Productos;
use App\Models\Clientes;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VentasResource extends Resource
{
    protected static ?string $model = Ventas::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_producto')
                ->label('Productos')
                ->options(
                    Productos::all()->pluck('nombre', 'id')->toArray()
                ),
                Forms\Components\Select::make('id_cliente')
                ->label('Clientes')
                ->options(
                    Clientes::all()->pluck('nombre', 'id')->toArray()
                ),
                Forms\Components\TextInput::make('cantidad')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('precio_venta')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('valor_unitario')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('soporte_compra')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_producto')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('id_cliente')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cantidad')
                    ->searchable(),
                Tables\Columns\TextColumn::make('precio_venta')
                    ->searchable(),
                Tables\Columns\TextColumn::make('valor_unitario')
                    ->searchable(),
                Tables\Columns\TextColumn::make('soporte_compra')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
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
            'index' => Pages\ListVentas::route('/'),
            'create' => Pages\CreateVentas::route('/create'),
            'edit' => Pages\EditVentas::route('/{record}/edit'),
        ];
    }
}
