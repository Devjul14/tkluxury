<?php

namespace App\Filament\Resources\InstituteResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentProfilesRelationManager extends RelationManager
{
    protected static string $relationship = 'studentProfiles';

    protected static ?string $recordTitleAttribute = 'student_id_number';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('student_id_number')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Forms\Components\TextInput::make('course_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('year_of_study')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(10),
                Forms\Components\DatePicker::make('graduation_date'),
                Forms\Components\TextInput::make('budget_min')
                    ->numeric()
                    ->prefix('$'),
                Forms\Components\TextInput::make('budget_max')
                    ->numeric()
                    ->prefix('$'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('student_id_number')
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Student Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('student_id_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('course_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('year_of_study')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('graduation_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('budget_min')
                    ->money('USD')
                    ->sortable(),
                Tables\Columns\TextColumn::make('budget_max')
                    ->money('USD')
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('year_of_study')
                    ->options([
                        1 => 'Year 1',
                        2 => 'Year 2',
                        3 => 'Year 3',
                        4 => 'Year 4',
                        5 => 'Year 5+',
                    ]),
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