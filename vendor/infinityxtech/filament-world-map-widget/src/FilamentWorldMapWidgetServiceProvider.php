<?php

namespace InfinityXTech\FilamentWorldMapWidget;

use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Asset;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use InfinityXTech\FilamentWorldMapWidget\Commands\FilamentWorldMapWidgetCommand;

class FilamentWorldMapWidgetServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-world-map-widget';

    public static string $viewNamespace = 'filament-world-map-widget';

    public function configurePackage(Package $package): void
    {
        $package->name(static::$name)
            ->hasCommands($this->getCommands())
            ->hasViews(static::$viewNamespace);
    }

    public function packageBooted(): void
    {
        // Asset Registration
        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName()
        );
    }

    protected function getAssetPackageName(): ?string
    {
        return 'InfinityXTech/filament-world-map-widget';
    }

    /**
     * @return array<Asset>
     */
    protected function getAssets(): array
    {
        return [
            AlpineComponent::make('filament-world-map-widget', __DIR__ . '/../resources/dist/filament-world-map-widget.js'),
            Css::make('filament-world-map-widget-styles', __DIR__ . '/../resources/dist/filament-world-map-widget.css'),
        ];
    }

    /**
     * @return array<class-string>
     */
    protected function getCommands(): array
    {
        return [
            FilamentWorldMapWidgetCommand::class,
        ];
    }
}
