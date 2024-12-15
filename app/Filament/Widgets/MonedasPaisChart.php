<?php

namespace App\Filament\Widgets;

use App\Models\Monedas;
use Filament\Widgets\ChartWidget;

class MonedasPaisChart extends ChartWidget
{
    protected static ?string $heading = 'Monedas por País';

    protected static ?int $sort = 2;


    protected function getType(): string
    {
        return 'doughnut'; // Especificamos el tipo de gráfico como "doughnut"
    }

    protected function getData(): array
    {
        // Obtener los datos agrupados por país
        $data = Monedas::query()
            ->selectRaw('pais, COUNT(*) as total')
            ->groupBy('pais')
            ->orderByDesc('total')
            ->get();

        return [
            'labels' => $data->pluck('pais')->toArray(), // Etiquetas con los nombres de los países
            'datasets' => [
                [
                    'label' => 'Cantidad de Monedas',
                    'data' => $data->pluck('total')->toArray(), // Cantidad de billetes por país
                    'backgroundColor' => $this->getColorPalette($data->count()), // Paleta de colores para el gráfico
                ],
            ],
        ];
    }

    /**
     * Generar una paleta de colores dinámica para los países.
     */
    private function getColorPalette(int $count): array
    {
        $colors = [
            '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF',
            '#FF9F40', '#E7E9ED', '#50B432', '#ED561B', '#24CBE5',
        ];

        // Repetimos los colores si hay más países que colores disponibles
        return array_slice(array_pad($colors, $count, $colors), 0, $count);
    }

    
}
