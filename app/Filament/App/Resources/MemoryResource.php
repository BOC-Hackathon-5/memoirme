<?php

namespace App\Filament\App\Resources;

use App\Models\Memory;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Dotswan\FilamentGrapesjs\Fields\GrapesJs;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\DateTimePicker;
use App\Filament\App\Resources\MemoryResource\Pages;
use App\Filament\App\Resources\MemoryResource\RelationManagers;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MemoryResource extends Resource
{
    protected static ?string $model = Memory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form( Form $form ): Form
    {
        return $form
            ->schema( [
                TextInput::make( 'ref' )->disabled()->hiddenOn( 'create' ),
                Wizard::make( [
                    Wizard\Step::make( 'New Memory' )
                        ->schema( [
                            Forms\Components\Select::make( 'type' )->options( [
                                'funeral' => 'Funeral Death Announcement',
                                'wedding' => 'Wedding',
                                'christening' => 'Christening',
                            ] ),
                            TextInput::make( 'name' )->required(),
                            TextInput::make( 'ceremony_location' )
                                ->label( 'Ceremony Location' )
                                ->required(),
                            DateTimePicker::make( 'start_at' )->native( false )->required(),
                            MarkdownEditor::make( 'description' ),
                            Forms\Components\Radio::make( 'ai' )
                                ->options( [
                                    'with' => 'Use our ai to help you compose the memory',
                                    'with_out' => '',
                                ] ),
                        ] ),
                    Wizard\Step::make( 'Receive Money' )
                        ->schema( [
                            TextInput::make( 'account_id' )
                                ->default( '351012345671' )->label( 'BOC Account Id' )
                                ->helperText( 'The Account you want to Receive money' )->required(),
                            Forms\Components\CheckboxList::make( 'organizations' )
                                ->options( [
                                    'anti-cancer' => 'Anti Cancer NGO',
                                    'church' => 'Church',
                                    'other' => 'Other',
                                ] ),
                            Forms\Components\ToggleButtons::make( 'upgrade' )->options( [
                                'option1' => '[10 euros] Share',
                                'option2' => '[20 euros] Share and allow Collaboration + Storage',

                            ] )->helperText( "Upgrade for 10euros for Extra Storage and sharing and collaborating with family and friends" ),
                        ] ),
                    Wizard\Step::make( 'Design' )
                        ->schema( [
                            GrapesJs::make( 'content' )->columnSpanFull()
                                ->id( 'page-content' ),
                        ] ),
                ] )->columnSpanFull(),

            ] );
    }

    public static function table( Table $table ): Table
    {
        return $table
            ->columns( [
                Tables\Columns\TextColumn::make( 'name' ),
            ] )
            ->filters( [
                //
            ] )
            ->actions( [
                Tables\Actions\EditAction::make(),
            ] )
            ->bulkActions( [
                Tables\Actions\BulkActionGroup::make( [
                    Tables\Actions\DeleteBulkAction::make(),
                ] ),
            ] );
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
            'index' => Pages\ListMemories::route( '/' ),
            'create' => Pages\CreateMemory::route( '/create' ),
            'edit' => Pages\EditMemory::route( '/{record}/edit' ),
        ];
    }
}
