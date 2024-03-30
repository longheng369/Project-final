<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductsResource\Pages;
use App\Filament\Resources\ProductsResource\RelationManagers;
use App\Models\Category;
use App\Models\Products;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\SelectFilter;

class ProductsResource extends Resource
{
    protected static ?string $model = Products::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Product Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('header')
                            ->required()
                            ->maxLength(255)
                            ->label('Header'),
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->label('Title'),
                        Forms\Components\TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('$')
                            ->label(''),
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('quantity')
                                    ->required()
                                    ->numeric()
                                    ->prefix('Quantity')
                                    ->columnSpan(5)
                                    ->label(''),
                                Forms\Components\TextInput::make('scale')
                                    ->required()
                                    ->prefix('Scale')
                                    ->columnSpan(3)
                                    ->label(''),
                            ])->columns(8),
                    ])->columnSpan(8),
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->required()
                            ->label('Image'),
                        Forms\Components\Select::make('category_type')
                            ->required()
                            ->options(Category::all()->pluck('title','title'))
                            ->searchable()
                            ->label('Category_type'),
                        Forms\Components\DateTimePicker::make('published_at')
                            ->required()
                            ->label('Published_at'),
                        Forms\Components\Toggle::make('active')
                            ->required()
                            ->onColor('success')
                            ->label('Active'),
                    ])->columnSpan(4),
                Forms\Components\Textarea::make('details')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),

            ])->columns(12);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('header')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\IconColumn::make('active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category_type')
                    ->options(Category::all()->pluck('title','title'))
                    ->label('Category'),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProducts::route('/create'),
            'view' => Pages\ViewProducts::route('/{record}'),
            'edit' => Pages\EditProducts::route('/{record}/edit'),
        ];
    }
}
