<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MonitorResource\Pages;
use App\Filament\Resources\MonitorResource\RelationManagers;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Spatie\UptimeMonitor\Models\Monitor;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MonitorResource extends Resource
{
    protected static ?string $model = Monitor::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                //            $table->string('url')->unique();
                TextInput::make('url')
                    ->afterStateHydrated(function (TextInput $component, $state) {
                        if (!is_null($state))
                            $component->state($state->__toString());
                    })
                    ->required(),
                //            $table->boolean('uptime_check_enabled')->default(true);
                Toggle::make('uptime_check_enabled'),
                //            $table->string('look_for_string')->default('');
                TextInput::make('look_for_string'),
                //            $table->string('uptime_check_interval_in_minutes')->default(5);
                TextInput::make('uptime_check_interval_in_minutes')
                    ->required(),
                //            $table->string('uptime_status')->default(UptimeStatus::NOT_YET_CHECKED);
                TextInput::make('uptime_status'),
                //            $table->text('uptime_check_failure_reason')->nullable();
                TextInput::make('uptime_check_failure_reason'),
                //            $table->integer('uptime_check_times_failed_in_a_row')->default(0);
                TextInput::make('uptime_check_times_failed_in_a_row'),
                //            $table->timestamp('uptime_status_last_change_date')->nullable();
                Forms\Components\DateTimePicker::make('uptime_status_last_change_date'),
                //            $table->timestamp('uptime_last_check_date')->nullable();
                Forms\Components\DateTimePicker::make('uptime_last_check_date'),
                //            $table->timestamp('uptime_check_failed_event_fired_on_date')->nullable();
                Forms\Components\DateTimePicker::make('uptime_check_failed_event_fired_on_date'),
                //            $table->string('uptime_check_method')->default('get');
                TextInput::make('uptime_check_method'),
                //            $table->text('uptime_check_payload')->nullable();
                TextInput::make('uptime_check_payload'),
                //            $table->text('uptime_check_additional_headers')->nullable();
                TextInput::make('uptime_check_additional_headers'),
                //            $table->string('uptime_check_response_checker')->nullable();
                TextInput::make('uptime_check_response_checker'),
                //            $table->boolean('certificate_check_enabled')->default(false);
                Toggle::make('certificate_check_enabled'),
                //            $table->string('certificate_status')->default(CertificateStatus::NOT_YET_CHECKED);
                TextInput::make('certificate_status'),
                //            $table->timestamp('certificate_expiration_date')->nullable();
                TextInput::make('certificate_expiration_date'),
                //            $table->string('certificate_issuer')->nullable();
                TextInput::make('certificate_issuer'),
                //            $table->string('certificate_check_failure_reason')->default('');
                TextInput::make('certificate_check_failure_reason'),
                //            $table->timestamps();
                Forms\Components\DateTimePicker::make('created_at'),
                Forms\Components\DateTimePicker::make('updated_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('300s')
            ->columns([

                //             $table->string('url')->unique();
                Tables\Columns\TextColumn::make('url')->sortable(),
                //            $table->boolean('uptime_check_enabled')->default(true);
                Tables\Columns\IconColumn::make('uptime_check_enabled')
                    ->boolean(),
                //            $table->string('look_for_string')->default('');
                Tables\Columns\TextColumn::make('look_for_string'),
                //            $table->string('uptime_check_interval_in_minutes')->default(5);
                Tables\Columns\TextColumn::make('uptime_check_interval_in_minutes'),
                //            $table->string('uptime_status')->default(UptimeStatus::NOT_YET_CHECKED);
                Tables\Columns\TextColumn::make('uptime_check_interval_in_minutes'),
                //            $table->text('uptime_check_interval_in_minutes')->nullable();
                Tables\Columns\TextColumn::make('uptime_check_interval_in_minutes'),
                //            $table->integer('uptime_check_interval_in_minutes')->default(0);
                Tables\Columns\TextColumn::make('uptime_check_times_failed_in_a_row'),

                //            $table->timestamp('uptime_status_last_change_date')->nullable();
                Tables\Columns\TextColumn::make('uptime_status_last_change_date')
                    ->dateTime(),
                //            $table->timestamp('uptime_last_check_date')->nullable();
                Tables\Columns\TextColumn::make('uptime_last_check_date')
                    ->dateTime(),
                //            $table->timestamp('uptime_check_failed_event_fired_on_date')->nullable();
                Tables\Columns\TextColumn::make('uptime_check_failed_event_fired_on_date')
                    ->dateTime(),
                //            $table->string('uptime_check_method')->default('get');
                Tables\Columns\TextColumn::make('uptime_check_method'),
                //            $table->text('uptime_check_payload')->nullable();
                Tables\Columns\TextColumn::make('uptime_check_method'),
                //            $table->text('uptime_check_additional_headers')->nullable();
                Tables\Columns\TextColumn::make('uptime_check_method'),
                //            $table->string('uptime_check_response_checker')->nullable();
                Tables\Columns\TextColumn::make('uptime_check_method'),
                //
                //            $table->boolean('certificate_check_enabled')->default(false);
                Tables\Columns\IconColumn::make('certificate_check_enabled')
                    ->boolean(),

                //            $table->string('certificate_status')->default(CertificateStatus::NOT_YET_CHECKED);
                Tables\Columns\TextColumn::make('uptime_check_method'),
                //            $table->timestamp('certificate_expiration_date')->nullable();
                Tables\Columns\TextColumn::make('uptime_check_failed_event_fired_on_date')
                    ->dateTime(),
                //            $table->string('certificate_issuer')->nullable();
                Tables\Columns\TextColumn::make('uptime_check_failed_event_fired_on_date'),
                //            $table->string('certificate_check_failure_reason')->default('');
                Tables\Columns\TextColumn::make('uptime_check_failed_event_fired_on_date'),
                //
                //            $table->timestamps();

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->defaultSort('url')
            ->filters([

            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListMonitors::route('/'),
            'create' => Pages\CreateMonitor::route('/create'),
            'view' => Pages\ViewMonitor::route('/{record}'),
            'edit' => Pages\EditMonitor::route('/{record}/edit'),
        ];
    }
}
