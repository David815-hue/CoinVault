<?php

namespace InfinityXTech\FilamentWorldMapWidget\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\View\View;
use InfinityXTech\FilamentWorldMapWidget\Enums\Map;

/**
 * Class WorldMapWidget
 * Represents a Filament widget for displaying a world map with configurable options.
 */
class WorldMapWidget extends Widget
{
    /**
     * @var string $view
     * The view file that renders the world map widget.
     */
    protected static string $view = 'filament-world-map-widget::widgets.world-map-widget';

    /**
     * Returns the stats to be displayed on the map.
     * Keys represent country codes, and values are the associated data points.
     *
     * @return array
     */
    public function stats(): array
    {
        return [
            'US' => 35000, // Data for the United States
            'RS' => 15000  // Data for Serbia
        ];
    }

    /**
     * Provides the heading text for the widget.
     *
     * @return string|Htmlable|null The heading text or HTML content.
     */
    public function heading(): string|Htmlable|null
    {
        return 'World Map'; // Default heading for the widget
    }

    /**
     * Provides the tooltip text for the widget.
     *
     * @return string|Htmlable Tooltip content or HTML.
     */
    public function tooltip(): string|Htmlable
    {
        return 'stats'; // Tooltip text displayed on hover
    }

    /**
     * Defines the map type to be displayed.
     *
     * @return Map|string The map type, defaults to the WORLD map.
     */
    public function map(): Map|string
    {
        return Map::WORLD; // Enum value for the world map
    }

    /**
     * Provides a custom URL for the map data, if any.
     *
     * @return string|null The custom map URL or null if not provided.
     */
    public function customMapUrl(): ?string
    {
        return null; // No custom map URL by default
    }

    /**
     * Specifies the RGB color values for the map.
     *
     * @return array The RGB color values as an array [R, G, B].
     */
    public function color(): array
    {
        return [0, 120, 215]; // Default blue color for the map
    }

    /**
     * Specifies the height of the widget container.
     *
     * @return string The height value in CSS-compatible format.
     */
    public function height(): string
    {
        return '332px'; // Default widget height
    }

    /**
     * Additional configuration options for the widget.
     *
     * @return array An array of additional options.
     */
    public function additionalOptions(): array
    {
        return []; // No additional options by default
    }

    /**
     * Renders the widget view.
     *
     * @return View The rendered view instance.
     */
    public function render(): View
    {
        return view(static::$view); // Render the specified widget view
    }
}
