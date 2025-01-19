# World map stats widget

[![Latest Version on Packagist](https://img.shields.io/packagist/v/infinityxtech/filament-world-map-widget.svg?style=flat-square)](https://packagist.org/packages/infinityxtech/filament-world-map-widget)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/infinityxtech/filament-world-map-widget/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/infinityxtech/filament-world-map-widget/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/infinityxtech/filament-world-map-widget/fix-php-code-styling.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/infinityxtech/filament-world-map-widget/actions?query=workflow%3A"Fix+PHP+code+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/infinityxtech/filament-world-map-widget.svg?style=flat-square)](https://packagist.org/packages/infinityxtech/filament-world-map-widget)



![image](https://github.com/user-attachments/assets/5373a841-6918-42b1-8227-698261a774b5)


## Installation

You can install the package via composer:

```bash
composer require infinityxtech/filament-world-map-widget
```

## Usage

```php
php artisan make:filament-map-widget MapWidget
```

## Available maps

```php
Map::WORLD
Map::WORLD_MERC
Map::US_MILL_EN
Map::US_MERC_EN
Map::US_LCC_EN
Map::US_AEA_EN
Map::SPAIN
Map::RUSSIA
Map::CANADA
Map::IRAQ
Map::BRASIL
```

## Available methods

```php
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
```

- To include custom map, you will need to make a url accessible js file that you can set with `customMapUrl()` and `map()` with custom naming.

```php
    public function map (): Map|string {
        return 'custom-map';
    }

    public function customMapUrl (): ?string {
        return 'https://example.test/js/custom-map.js';
    }
```
## For more additional options check: [Jsvectormap](https://jvm-docs.vercel.app/docs/introduction)

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [InfinityX Tech](https://github.com/InfinityXTech)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
