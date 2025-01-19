<?php

namespace App\Filament\Widgets;

use InfinityXTech\FilamentWorldMapWidget\Widgets\WorldMapWidget;
use App\Models\Monedas;

class MapWidget extends WorldMapWidget
{
    protected static ?int $sort = 3;
    protected static string $uid = 'monedas-map';
    protected static ?string $heading = 'Monedas por País';

    public function stats(): array
    {
        $data = Monedas::where('user_id', auth()->id())
            ->selectRaw('pais as country_code, COUNT(*) as total')
            ->groupBy('pais')
            ->get();

        return $data->pluck('total', 'country_code')->toArray();
    }

    public function color(): array
    {
        return [0, 105, 192]; // Un azul distinto para monedas
    }
 
    public function tooltip(): string
    {
        return 'Monedas';
    }

    public function heading(): string
    {
        return static::$heading;
    }

    public function additionalOptions(): array
    {
        return [
            'regionStyle' => [
                'initial' => [
                    'fill' => '#e4e4e4',
                ],
                'selected' => [
                    'fill' => '#0069C0' // Un azul distinto para monedas
                ]
            ],
            'focusOn' => [
                'x' => 0.5,
                'y' => 0.5,
                'scale' => 1
            ],
            'selectedRegions' => array_keys($this->stats()),
            'zoomAnimate' => true,
            'zoomMax' => 8,
            'zoomMin' => 1,
            'zoomStep' => 1.5,
            'zoomButtons' => [
                'enable' => true,
                'single' => true
            ],
            'panOnDrag' => true
        ];
    }
}