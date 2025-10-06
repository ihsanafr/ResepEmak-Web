<?php

namespace App\Filament\Resources\Recipes\Tables;

use Dom\Text;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Forms\Components\Select;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Ingredient;


class RecipesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('name')
                ->searchable(),

                TextColumn::make('category.name')
                ->searchable(),

                ImageColumn::make('author.photo')
                ->circular(),

                ImageColumn::make('thumbnail')


            ])
            ->filters([

                SelectFilter::make('recipe_author_id')
                ->label('Author')
                ->relationship('author', 'name'),

                SelectFilter::make('category_id')
                ->label('Category')
                ->relationship('category', 'name'),

                SelectFilter::make('Ingredients_id')
                ->label('Ingredients')
                ->options(Ingredient::pluck('name', 'id'))
                ->query(function (Builder $query, array $data) {
                    if ($data['value']) {
                        $query->whereHas('recipeIngredients', function ($query) use ($data) {
                            $query->where('ingredient_id', $data['value']);
                        });
                    }
                }),               
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
