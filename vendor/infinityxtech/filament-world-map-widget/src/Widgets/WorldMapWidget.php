<?php

namespace InfinityXTech\FilamentWorldMapWidget\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\View;
use InfinityXTech\FilamentWorldMapWidget\Enums\Map;

class WorldMapWidget extends Widget
{
    protected static string $view = 'filament-world-map-widget::widgets.world-map-widget';

    public function stats () {
        return [
            'US' => 35000,
            'RS' => 15000
        ];
    }

    public function heading ():string|Htmlable|null {
        return 'World Map';
    }

    public function tooltip ():string|Htmlable {
        return 'stats';
    }

    public function map ():Map {
        return Map::WORLD;
    }

    public function color ():array {
        return [0, 120, 215];
    }

    public function height ():string {
        return '332px';
    }

    public function additionalOptions ():array {
        return [];
    }

    public function render(): View
    {
        return view(static::$view);
    }
}
