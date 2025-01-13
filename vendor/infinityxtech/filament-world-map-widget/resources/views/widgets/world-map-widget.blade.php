@use('Filament\Support\Facades\FilamentAsset')
<x-filament-widgets::widget>
    <div ax-load
        ax-load-src="{{ FilamentAsset::getAlpineComponentSrc('filament-world-map-widget', 'InfinityXTech/filament-world-map-widget') }}"
        x-data="initWorldMapWidget({
            stats: JSON.parse('{{ json_encode($this->stats()) }}'),
            tooltipText: '{{ $this->tooltip() }}',
            map: '{{ $this->map()->value }}',
            color: JSON.parse('{{ json_encode($this->color()) }}'),
            selector: '#map',
            additionalOptions: JSON.parse('{{ json_encode($this->additionalOptions()) }}'),
        })"
        x-init="init()">
        <x-filament::section>
            @if(!empty($this->heading()))
                <x-filament::section.heading>
                    {{ $this->heading() }}
                </x-filament::section.heading>
            @endif
            <div wire:ignore>
                <div id="map" style="height: {{ $this->height() }}"></div>
            </div>
        </x-filament::section>
    </div>
</x-filament-widgets::widget>
