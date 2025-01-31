@use('Filament\Support\Facades\FilamentAsset')
<x-filament-widgets::widget>
    <div
        x-ignore
        ax-load
        ax-load-src="{{ FilamentAsset::getAlpineComponentSrc('filament-world-map-widget', 'InfinityXTech/filament-world-map-widget') }}"
        x-data="initWorldMapWidget({
            stats: JSON.parse('{{ json_encode($this->stats()) }}'),
            tooltipText: '{{ $this->tooltip() }}',
            map: '{{ is_string($this->map()) ? $this->map() : $this->map()->value }}',
            color: JSON.parse('{{ json_encode($this->color()) }}'),
            selector: '#{{ $this->getMapId() }}',
            additionalOptions: JSON.parse('{{ json_encode($this->additionalOptions()) }}'),
            customMapUrl: '{{ $this->customMapUrl() }}'
        })"
        x-init="init()">
        <x-filament::section>
            @if(!empty($this->heading()))
                <x-filament::section.heading>
                    {{ $this->heading() }}
                </x-filament::section.heading>
            @endif
            <div wire:ignore>
                <div id="{{ $this->getMapId() }}" style="height: {{ $this->height() }}"></div>
            </div>
        </x-filament::section>
    </div>
</x-filament-widgets::widget>
