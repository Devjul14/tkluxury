<?php

namespace App\Filament\Resources\BookingResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContractRelationManager extends RelationManager
{
    protected static string $relationship = 'contracts';

    protected static ?string $recordTitleAttribute = 'contract_number';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('contract_template_id')
                    ->relationship('contractTemplate', 'name')
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('contract_number')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Forms\Components\Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'pending_signature' => 'Pending Signature',
                        'active' => 'Active',
                        'expired' => 'Expired',
                        'terminated' => 'Terminated',
                    ])
                    ->required(),
                Forms\Components\DatePicker::make('start_date')
                    ->required(),
                Forms\Components\DatePicker::make('end_date')
                    ->required(),
                Forms\Components\TextInput::make('duration_months')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->suffix('months'),
                Forms\Components\TextInput::make('monthly_rent')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Forms\Components\TextInput::make('security_deposit')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('contract_number')
            ->columns([
                Tables\Columns\TextColumn::make('contract_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('contractTemplate.name')
                    ->label('Template'),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('duration_months')
                    ->numeric()
                    ->sortable()
                    ->suffix(' months'),
                Tables\Columns\TextColumn::make('monthly_rent')
                    ->money('USD')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'pending_signature' => 'warning',
                        'active' => 'success',
                        'expired' => 'danger',
                        'terminated' => 'primary',
                    }),
                Tables\Columns\TextColumn::make('student_signed_date')
                    ->date()
                    ->label('Student Signed'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'pending_signature' => 'Pending Signature',
                        'active' => 'Active',
                        'expired' => 'Expired',
                        'terminated' => 'Terminated',
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