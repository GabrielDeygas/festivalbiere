<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RecipeResource\Pages;
use App\Models\Recipe;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class RecipeResource extends Resource
{
    protected static ?string $model = Recipe::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Textarea::make('name')
                    ->label('Nom de la recette')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Ecrivez le nom de la recette'),
                Textarea::make('ingredients')
                    ->label('Ingrédients')
                    ->required()
                    ->placeholder('Listez les ingrédients séparés par des virgules'),
                Textarea::make('steps')
                    ->label('Étapes')
                    ->required()
                    ->placeholder('Décrivez les étapes de la recette'),
                Select::make('user_id')
                    ->label('Utilisateur')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->placeholder('Sélectionnez un utilisateur')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('id')->label('ID')->sortable(),
            TextColumn::make('ingredients')
                ->label('Ingrédients'),
            TextColumn::make('steps')
                ->label('Étapes'),
            TextColumn::make('user.name')
                ->label('Utilisateur')
                ->sortable()
                ->searchable(),
            TextColumn::make('created_at')
                ->label('Créé le')
                ->dateTime()
                ->sortable(),
        ])
        ->filters([
            SelectFilter::make('user_id')
                ->label('Utilisateur')
                ->relationship('user', 'name')
                ->placeholder('Tous les utilisateurs'),
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
            'index' => Pages\ListRecipes::route('/'),
            'create' => Pages\CreateRecipe::route('/create'),
            'edit' => Pages\EditRecipe::route('/{record}/edit'),
        ];
    }
}
