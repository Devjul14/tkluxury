<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContractResource\Pages;
use App\Filament\Resources\ContractResource\RelationManagers;
use App\Models\Contract;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContractResource extends Resource
{
    protected static ?string $model = Contract::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    
    protected static ?string $navigationGroup = 'Financial Management';
    
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Contract Information')
                    ->schema([
                        Forms\Components\Select::make('booking_id')
                            ->relationship('booking', 'booking_reference')
                            ->searchable()
                            ->required(),
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
                    ])->columns(2),
                
                Forms\Components\Section::make('Contract Details')
                    ->schema([
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
                    ])->columns(2),
                
                Forms\Components\Section::make('Terms and Conditions')
                    ->schema([
                        Forms\Components\RichEditor::make('terms_and_conditions')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('special_conditions')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                    ])->columns(1),
                
                Forms\Components\Section::make('Signatures')
                    ->schema([
                        Forms\Components\DatePicker::make('student_signed_date'),
                        Forms\Components\DatePicker::make('landlord_signed_date'),
                        Forms\Components\DatePicker::make('witness_signed_date'),
                        Forms\Components\FileUpload::make('student_signature')
                            ->directory('contracts/signatures'),
                        Forms\Components\FileUpload::make('landlord_signature')
                            ->directory('contracts/signatures'),
                    ])->columns(2),
                
                Forms\Components\Section::make('Additional Information')
                    ->schema([
                        Forms\Components\Textarea::make('notes')
                            ->maxLength(65535)
                            ->columnSpanFull(),
                        Forms\Components\FileUpload::make('attachments')
                            ->multiple()
                            ->directory('contracts/attachments'),
                    ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('contract_number')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('booking.booking_reference')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('booking.student.name')
                    ->label('Student')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('contractTemplate.name')
                    ->label('Template')
                    ->searchable(),
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
                Tables\Filters\SelectFilter::make('booking')
                    ->relationship('booking', 'booking_reference'),
                Tables\Filters\Filter::make('start_date')
                    ->form([
                        Forms\Components\DatePicker::make('start_date_from'),
                        Forms\Components\DatePicker::make('start_date_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['start_date_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('start_date', '>=', $date),
                            )
                            ->when(
                                $data['start_date_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('start_date', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListContracts::route('/'),
            'create' => Pages\CreateContract::route('/create'),
            'view' => Pages\ViewContract::route('/{record}'),
            'edit' => Pages\EditContract::route('/{record}/edit'),
        ];
    }
}
