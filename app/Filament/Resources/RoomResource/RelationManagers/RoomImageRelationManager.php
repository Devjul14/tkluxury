<?php

namespace App\Filament\Resources\RoomResource\RelationManagers;

use App\Models\RoomImage;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Tables;
use Illuminate\Support\Str;

class RoomImageRelationManager extends RelationManager
{
    protected static string $relationship = 'images';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Repeater::make('images')
                    ->label('Images')
                    ->createItemButtonLabel('Add Image')
                    ->schema([
                        Forms\Components\FileUpload::make('image_path')
                            ->label('Image')
                            ->image()
                            ->required()
                            ->directory('room-images'),
                        Forms\Components\TextInput::make('alt_text')
                            ->label('Alt Text')
                            ->maxLength(255),
                        Forms\Components\Toggle::make('is_primary')
                            ->label('Primary Image')
                            ->default(false),
                    ])
                    ->columns(1)
                    ->minItems(1)
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('image_path')
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Image')
                    ->getStateUsing(function ($record) {
                        $path = $record->image_path;

                        if (blank($path)) {
                            return null;
                        }

                        // Kalau sudah URL langsung return
                        if (Str::startsWith($path, ['http://', 'https://'])) {
                            return $path;
                        }

                        // Ambil dari storage disk public
                        return asset('/storage/' . $path);
                    }),
                Tables\Columns\TextColumn::make('alt_text')->label('Alt Text'),
                Tables\Columns\BooleanColumn::make('is_primary')->label('Primary'),
                Tables\Columns\TextColumn::make('updated_at')->label('Updated At'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->disableCreateAnother()
                    ->action(function (array $data, RelationManager $livewire) {
                        $parent = $livewire->getOwnerRecord();
                        $lastSortOrder = $parent->images()->max('sort_order') ?? 0;

                        foreach ($data['images'] as $index => $imageData) {
                            $parent->images()->create([
                                'image_path' => $imageData['image_path'],
                                'alt_text' => $imageData['alt_text'] ?? '',
                                'is_primary' => $imageData['is_primary'] ?? false,
                                'room_type' => null,
                                'sort_order' => $lastSortOrder + $index + 1,
                            ]);
                        }
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('view')
                    ->label('View')
                    ->action(function (RoomImage $record) {
                        $path = $record->image_path;

                        if (blank($path)) {
                            return null;
                        }

                        // Kalau sudah URL langsung return
                        if (Str::startsWith($path, ['http://', 'https://'])) {
                            return redirect()->away($path);
                        }

                        // Ambil dari storage disk public
                        return redirect()->away(asset('/storage/' . $path));
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
