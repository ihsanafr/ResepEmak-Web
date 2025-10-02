<?php

namespace App\Filament\Resources\Categories\Schemas;

use Faker\Extension\Helper;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Schema;
use Filament\Forms;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //
                Forms\Components\TextInput::make('name')
                ->helperText('Gunakan nama dengan tepat.')
                ->required()
                ->maxLength(255),

                Forms\Components\FileUpload::make('icon')
                ->image()
                ->required()
            ]);
    }
}
