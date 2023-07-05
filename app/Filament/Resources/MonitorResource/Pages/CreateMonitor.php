<?php

namespace App\Filament\Resources\MonitorResource\Pages;

use App\Filament\Resources\MonitorResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMonitor extends CreateRecord
{
    protected static string $resource = MonitorResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {

        ray()->clearAll();
        ray($data);

        $data['uptime_check_interval_in_minutes'] ??= 5;
        $data['uptime_status'] ??= 'not yet checked';
        $data['uptime_check_times_failed_in_a_row'] ??= '0';
        $data['uptime_check_method'] ??= 'get';
        $data['look_for_string'] ??= '';
        $data['certificate_check_failure_reason'] ??= '';
        $data['certificate_status'] ??= '';
        $data['uptime_check_additional_headers'] ??= [];

        ray($data);
        return $data;
    }
}
