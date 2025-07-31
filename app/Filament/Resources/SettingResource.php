<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Filament\Resources\SettingResource\RelationManagers;
use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\{TextInput, Select, Textarea, FileUpload, Toggle};
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;


class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function getNavigationLabel(): string
    {
        return 'Site Settings';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Configuration';
    }

    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-cog';
    }

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }

    public static function getNavigationSort(): int
    {
        return 9999;
    }



    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('group')
                    ->options([
                        'homepage' => 'Homepage',
                        'seo' => 'SEO',
                        'footer' => 'Footer',
                        'general' => 'General',
                    ])
                    ->required(),

                TextInput::make('key')
                    ->required()
                    ->unique(ignoreRecord: true),

                Select::make('type')
                    ->options([
                        'text' => 'Text',
                        'textarea' => 'Textarea',
                        'boolean' => 'Boolean',
                        'image' => 'Image',
                        'json' => 'JSON',
                    ])
                    ->required()
                    ->reactive(),

                // Dinamis tergantung 'type'
                TextInput::make('value')
                    ->label('Value')
                    ->visible(fn($get) => $get('type') === 'text'),

                Textarea::make('value')
                    ->label('Value')
                    ->visible(fn($get) => $get('type') === 'textarea'),

                Toggle::make('value')
                    ->label('Value')
                    ->visible(fn($get) => $get('type') === 'boolean'),

                FileUpload::make('value')
                    ->label('Value')
                    ->disk('public')
                    ->directory('settings')
                    ->visible(fn($get) => $get('type') === 'image'),

                Select::make('parent_id')
                    ->label('Parent Setting')
                    ->relationship('parent', 'key')
                    ->nullable(),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('group'),
                TextColumn::make('key'),
                TextColumn::make('value')->limit(50),
                TextColumn::make('type'),
            ])
            ->filters([
                SelectFilter::make('group')
                    ->options([
                        'homepage' => 'Homepage',
                        'seo' => 'SEO',
                        'footer' => 'Footer',
                        'general' => 'General',
                    ]),
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
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }
}
