<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BeerResource\Pages;
use App\Filament\Resources\BeerResource\RelationManagers;
use App\Models\Beer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;

class BeerResource extends Resource
{
    protected static ?string $model = Beer::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            TextInput::make('name')
                ->label('Nom')
                ->required()
                ->maxLength(255),
            TextInput::make('abv')
                ->label('Alcool (%)')
                ->numeric()
                ->required(),
            Select::make('type')
                ->label('Type')
                ->options([
                    'Blonde' => 'Blonde',
                    'Brune' => 'Brune',
                    'IPA' => 'IPA',
                    'Porter' => 'Porter',
                    'Lager' => 'Lager',
                ])
                ->required()
                ->placeholder('Choisissez un type'),
            Select::make('category')
                ->label('Catégorie')
                ->options([
                    'Belgian Ale' => 'Belgian Ale',
                    'India Pale Ale' => 'India Pale Ale',
                    'Pilsner' => 'Pilsner',
                    'Dark Ale' => 'Dark Ale',
                ])
                ->required()
                ->placeholder('Choisissez une catégorie'),
            TextInput::make('flavor')
                ->label('Saveur')
                ->nullable(),
            Select::make('country_id')
                ->label('Pays d\'origine')
                ->relationship('country', 'name')
                ->searchable()
                ->placeholder('Choisissez un pays')
                ->required(),
            FileUpload::make('img')
                ->label('Image de la bière')
                ->directory('beers')
                ->image()
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nom')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('type')
                    ->label('Type')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('category')
                    ->label('Catégorie')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('flavor')
                    ->label('Saveur'),
                TextColumn::make('abv')
                    ->label('Alcool (%)')
                    ->sortable(),
                TextColumn::make('country.name')
                    ->label('Pays d\'origine')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('img')
                    ->label('Image'),
            ])
            ->filters([
                SelectFilter::make('country_id')
                    ->label('Pays d\'origine')
                    ->relationship('country', 'name')
                    ->placeholder('Tous les pays'),
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
            'index' => Pages\ListBeers::route('/'),
            'create' => Pages\CreateBeer::route('/create'),
            'edit' => Pages\EditBeer::route('/{record}/edit'),
        ];
    }
}
