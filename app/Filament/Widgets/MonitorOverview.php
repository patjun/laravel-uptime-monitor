<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use Illuminate\Database\Eloquent\Collection;
use Spatie\UptimeMonitor\Models\Enums\UptimeStatus;
use Spatie\UptimeMonitor\Models\Monitor;

class MonitorOverview extends BaseWidget
{
    protected static ?string $pollingInterval = null;

    protected function getCards(): array
    {


        /** @var Collection<int, Monitor> $montors */
        $montors = Monitor::all();

        $cards = [];

        foreach ($montors as $montor) {

            $card = Card::make($montor->url, 'Status: ' . $montor->uptime_status);

            if ($montor->uptime_status === UptimeStatus::DOWN) {
                $card->color('danger')
                    ->description($montor->uptime_check_failure_reason);
            } elseif ($montor->uptime_status === UptimeStatus::NOT_YET_CHECKED) {
                $card->color('warning')
                    ->description('Awaiting first check');
            } else {
                $card->color('success')
                    ->description('Ok');
            }

            $cards[] = $card;
        }

        return $cards;
    }
}
