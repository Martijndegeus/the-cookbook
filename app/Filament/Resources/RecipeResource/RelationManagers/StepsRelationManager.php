<?php

namespace App\Filament\Resources\RecipeResource\RelationManagers;

use Filament\Actions\ViewAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StepsRelationManager extends RelationManager
{
    protected static string $relationship = 'steps';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('duration')
                    ->nullable(),
                Forms\Components\TextInput::make('unit')
                    ->nullable(),
                Forms\Components\RichEditor::make('action')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->defaultSort('order')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->formatStateUsing(function (string $state, Model $record): string {
                        return $record->order . '. ' . $state;
                    }),
                Tables\Columns\TextColumn::make('duration')
                    ->formatStateUsing(function (string $state): string {
                        return "$state min";
                    })
                    ->summarize([
                        Tables\Columns\Summarizers\Sum::make()
                            ->formatStateUsing(function (string $state): string {
                                $hours = floor($state / 60) ?? 0;
                                $minutes = $state % 60 ?? 0;
                                return $hours . 'h' . $minutes . 'm';
                            })
                            ->label(__('Total time')),
                    ]),
            ])
            ->reorderable('order')

            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
