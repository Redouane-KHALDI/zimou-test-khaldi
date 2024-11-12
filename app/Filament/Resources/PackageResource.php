<?php

namespace App\Filament\Resources;

use App\Exports\PackagesExport;
use App\Filament\Resources\PackageResource\Pages;
use App\Filament\Resources\PackageResource\RelationManagers;
use App\Models\Package;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class PackageResource extends Resource
{
    protected static ?string $model = Package::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Hidden::make('tracking_code')
                    ->label('Tracking Code')
                    ->default(fn () => 'TRACK' . rand(10000000, 99999999))
                    ->unique(),

                Hidden::make('uuid')
                    ->default(fn () => (string) Str::uuid()),

                Select::make('commune_id')
                    ->relationship('commune', 'name')
                    ->required()
                    ->searchable()
                    ->label('Commune'),

                Select::make('delivery_type_id')
                    ->relationship('deliveryType', 'name')
                    ->required()
                    ->label('Delivery Type'),

                Select::make('status_id')
                    ->relationship('status', 'name')
                    ->required()
                    ->label('Status'),

                Select::make('store_id')
                    ->relationship('store', 'name')
                    ->required()
                    ->label('Store'),

                TextInput::make('address')
                    ->required()
                    ->label('Address')
                    ->maxLength(255),

                Toggle::make('can_be_opened')
                    ->label('Can Be Opened')
                    ->default(true),

                TextInput::make('name')
                    ->label('Package Name')
                    ->nullable()
                    ->maxLength(255),

                TextInput::make('client_first_name')
                    ->required()
                    ->label('Client First Name')
                    ->maxLength(255),

                TextInput::make('client_last_name')
                    ->required()
                    ->label('Client Last Name')
                    ->maxLength(255),

                TextInput::make('client_phone')
                    ->required()
                    ->label('Client Phone')
                    ->maxLength(30),

                TextInput::make('client_phone2')
                    ->label('Client Phone 2')
                    ->nullable()
                    ->maxLength(30),

                TextInput::make('cod_to_pay')
                    ->required()
                    ->label('COD to Pay')
                    ->numeric()
                    ->default(0),

                TextInput::make('commission')
                    ->required()
                    ->label('Commission')
                    ->numeric()
                    ->default(0),

                DateTimePicker::make('status_updated_at')
                    ->label('Status Updated At')
                    ->nullable(),

                DateTimePicker::make('delivered_at')
                    ->label('Delivered At')
                    ->nullable(),

                TextInput::make('extra_weight_price')
                    ->required()
                    ->label('Extra Weight Price')
                    ->numeric()
                    ->default(0),

                Toggle::make('free_delivery')
                    ->label('Free Delivery')
                    ->default(false),

                TextInput::make('delivery_price')
                    ->label('Delivery Price')
                    ->numeric()
                    ->required(),

                TextInput::make('packaging_price')
                    ->required()
                    ->label('Packaging Price')
                    ->numeric()
                    ->default(0),

                TextInput::make('partner_cod_price')
                    ->required()
                    ->label('Partner COD Price')
                    ->numeric()
                    ->default(0),

                TextInput::make('partner_delivery_price')
                    ->required()
                    ->label('Partner Delivery Price')
                    ->numeric()
                    ->default(0),

                TextInput::make('partner_return')
                    ->required()
                    ->label('Partner Return')
                    ->numeric()
                    ->default(0),
                TextInput::make('price')
                    ->required()
                    ->label('Price')
                    ->numeric()
                    ->default(0),

                TextInput::make('price_to_pay')
                    ->required()
                    ->label('Price to Pay')
                    ->numeric()
                    ->default(0),

                TextInput::make('return_price')
                    ->required()
                    ->label('Return Price')
                    ->numeric()
                    ->default(0),

                TextInput::make('total_price')
                    ->required()
                    ->label('Total Price')
                    ->numeric()
                    ->default(0),

                TextInput::make('weight')
                    ->required()
                    ->label('Weight (grams)')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tracking_code')
                    ->searchable(),
                TextColumn::make('store.name')
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('store.status')
                    ->label('Status')
                    ->searchable(),
                TextColumn::make('client_first_name')
                    ->label('Client Name')
                    ->formatStateUsing(fn ($record) => "{$record->client_first_name} {$record->client_last_name}"),

                TextColumn::make('client_phone')
                    ->searchable(),
                TextColumn::make('commune.name')
                    ->searchable(),
                TextColumn::make('commune.wilaya.name')
                    ->searchable(),
                TextColumn::make('deliveryType.name')
                    ->searchable(),
                TextColumn::make('status.name')
                    ->label('Status name')
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('store_id')
                ->label('Store')
                    ->relationship('store', 'name'),

                SelectFilter::make('commune_id')
                    ->label('Commune')
                    ->relationship('commune', 'name'),

                SelectFilter::make('delivery_type_id')
                ->label('Delivery Type')
                    ->relationship('deliveryType', 'name'),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->headerActions([
                Action::make('export')
                    ->label('Export Packages Excel')
                    ->action(function () {
                        return Excel::download(new PackagesExport, 'packages.xlsx');
                    })
                    ->color('primary'),
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

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPackages::route('/'),
            'create' => Pages\CreatePackage::route('/create'),
            'edit' => Pages\EditPackage::route('/{record}/edit'),
        ];
    }
}
