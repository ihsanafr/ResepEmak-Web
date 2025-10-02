<?php

namespace App\Filament\Resources\RecipeAuthors\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;

class RecipeAuthorForm
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
