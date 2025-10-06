<?php

namespace App\Filament\Resources\Recipes\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;
use Filament\Schemas\Components\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;


class RecipeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                TextInput::make('name')
                ->required()
                ->maxLength(255),

                FileUpload::make('thumbnail')
                ->image()
                ->required(),

                Textarea::make('about')
                ->required()
                ->rows(10)
                ->cols(10),

                Repeater::make('RecipeIngredients')
                ->relationship()
                ->schema([
                    Select::make('ingredient_id')
                    ->relationship('ingredient', 'name')
                    ->required(),
                    
                ]),

                Repeater::make('photos')
                ->relationship('photos')
                ->schema([
                        FileUpload::make('photo')
                        ->image()
                        ->required()
                ]),

                Select::make('recipe_author_id')
                ->relationship('author', 'name')
                ->searchable()
                ->preload()
                ->required(),

                Select::make('category_id')
                ->relationship('category', 'name')
                ->searchable()
                ->preload()
                ->required(),

                TextInput::make('url_video')
                ->required()
                ->maxLength(255),

                FileUpload::make('url_file')
                ->downloadable()
                ->uploadingMessage('Uploading Recipes...')
                ->acceptedFileTypes(['application/pdf'])
                ->required(),
            ]);
    }
}
