<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeLevelResource\Pages;
use App\Filament\Resources\EmployeeLevelResource\RelationManagers;
use App\Models\EmployeeLevel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeeLevelResource extends Resource
{
    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $model = EmployeeLevel::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('level_name')
                    ->required()
                    ->maxLength(64),
                Forms\Components\Select::make('level_position')
                    ->options([
                        'Single' => 'Single',
                        'Multiple' => 'Multiple',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('level_name'),
                Tables\Columns\TextColumn::make('level_position'),
            ])
            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListEmployeeLevels::route('/'),
            'create' => Pages\CreateEmployeeLevel::route('/create'),
            'edit' => Pages\EditEmployeeLevel::route('/{record}/edit'),
        ];
    }
}
