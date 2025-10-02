<?php

namespace App\Filament\Resources\Ingredients\Schemas;

use Filament\Schemas\Schema;

use function Laravel\Prompts\form;
use Filament\Forms;


class IngredientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),

                Forms\Components\FileUpload::make('photo')
                ->image()
                ->required()
            ]);
    }
}
