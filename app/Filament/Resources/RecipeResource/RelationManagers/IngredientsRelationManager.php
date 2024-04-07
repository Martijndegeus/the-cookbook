<?php

namespace App\Filament\Resources\RecipeResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IngredientsRelationManager extends RelationManager
{
    protected static string $relationship = 'ingredients';

    public function form(Form $form): Form
    {
        return $form
            ->columns([
                'sm'  => 4,
                'xl'  => 8,
                '2xl' => 10,
            ])
            ->schema([
                Forms\Components\TextInput::make('quantity')
                    ->columnSpan([
                        'sm'  => 1,
                        'xl'  => 2,
                        '2xl' => 2,
                    ])
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('unit')
                    ->columnSpan([
                        'sm'  => 1,
                        'xl'  => 2,
                        '2xl' => 2,
                    ])
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('name')
                    ->columnSpan([
                        'sm'  => 2,
                        'xl'  => 4,
                        '2xl' => 6,
                    ])
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('quantity'),
                Tables\Columns\TextColumn::make('unit'),
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
