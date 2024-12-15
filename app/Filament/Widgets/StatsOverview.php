<?php

namespace App\Filament\Widgets;

use App\Models\Billetes;
use App\Models\Monedas;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Billetes', value: Billetes::count())
                ->description('Billetes Registrados')
                ->icon('heroicon-o-currency-dollar')
                ->color('info'),
            Stat::make('Monedas', value: Monedas::count())
                ->description('Monedas Registradas')
                ->icon('heroicon-o-banknotes')

                ->color('info'),
        ];
    }

    protected function getColumns(): int
    {
        return 2; // Dividir los widgets en dos columnas
    }
}
