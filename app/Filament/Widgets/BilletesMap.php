<?php

namespace App\Filament\Widgets;

use InfinityXTech\FilamentWorldMapWidget\Widgets\WorldMapWidget;
use App\Models\Billetes;


class BilletesMap extends WorldMapWidget
{
    protected static ?int $sort = 2;
    protected static string $uid = 'billetes-map';

    // Sobreescribir el método que genera el ID del contenedor del mapa
    public function getMapId(): string
    {
        return 'map-billetes';
    }

    public function stats(): array
    {
        $data = Billetes::where('user_id', auth()->id())
            ->selectRaw('pais as country_code, COUNT(*) as total')
            ->groupBy('pais')
            ->get();

        return $data->pluck('total', 'country_code')->toArray();
    }

    public function color(): array
    {
        return [76, 175, 80]; // Verde para billetes
    }
 
    public function tooltip(): string
    {
        return 'Billetes';
    }

    public function heading(): string
    {
        return 'Billetes por País';
    }

    public function additionalOptions(): array
    {
        return [
            'regionStyle' => [
                'initial' => [
                    'fill' => '#e4e4e4',
                ],
                'selected' => [
                    'fill' => '#4CAF50'
                ]
            ],
            'focusOn' => [
                'x' => 0.5,
                'y' => 0.5,
                'scale' => 1
            ],
            'selector' => '#' . $this->getMapId(), // Usar el ID único
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