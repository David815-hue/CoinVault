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

## Available methods

```php
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
    return [0, 120, 215]; // rgb value
}

public function height ():string;

public function additionalOptions ():array {
    return [];
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
