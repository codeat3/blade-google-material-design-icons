<p align="center">
    <img src="https://banners.beyondco.de/Blade%20Google%20Material%20Design%20Icons.png?theme=light&packageManager=composer+require&packageName=codeat3%2Fblade-google-material-design-icons&pattern=architect&style=style_1&description=A+package+to+use+Google+Fonts+Material+Icons+in+your+Laravel+Blade+views&md=1&showWatermark=1&fontSize=100px&images=https%3A%2F%2Flaravel.com%2Fimg%2Flogomark.min.svg" width="1280" title="Social Card Blade Google Material Design Icons">
</p>

# Blade Google Material Design Icons

<a href="https://github.com/codeat3/blade-google-material-design-icons/actions?query=workflow%3ATests">
    <img src="https://github.com/codeat3/blade-google-material-design-icons/workflows/Tests/badge.svg" alt="Tests">
</a>
<a href="https://github.styleci.io/repos/258753939">
    <img src="https://github.styleci.io/repos/258753939/shield?style=flat" alt="Code Style">
</a>
<a href="https://packagist.org/packages/codeat3/blade-google-material-design-icons">
    <img src="https://img.shields.io/packagist/v/codeat3/blade-google-material-design-icons" alt="Latest Stable Version">
</a>
<a href="https://packagist.org/packages/codeat3/blade-google-material-design-icons">
    <img src="https://img.shields.io/packagist/dt/codeat3/blade-google-material-design-icons" alt="Total Downloads">
</a>

A package to easily make use of [Google Material Design Icons](https://github.com/google/material-design-icons) in your Laravel Blade views.

For a full list of available icons see [the SVG directory](resources/svg) or preview them at [fonts.google.com](https://fonts.google.com/icons).

## Requirements

- PHP 7.3 or higher
- Laravel 7.14 or higher

## Installation

```bash
composer require codeat3/blade-google-material-design-icons
```

## Updating

Please refer to [`the upgrade guide`](UPGRADE.md) when updating the library.

## Usage

Icons can be used as self-closing Blade components which will be compiled to SVG icons:

```blade
<x-gmdi-backup/>
```

You can also pass classes to your icon components:

```blade
<x-gmdi-backup class="w-6 h-6 text-gray-500"/>
```

And even use inline styles:

```blade
<x-gmdi-backup style="color: #555"/>
```

The outlined icons can be referenced like this:

```blade
<x-gmdi-backup-o/>
```

The round icons can be referenced like this:

```blade
<x-gmdi-backup-r/>
```

The sharp icons can be referenced like this:

```blade
<x-gmdi-backup-s/>
```

The two tone icons can be referenced like this:

```blade
<x-gmdi-backup-tt/>
```

### Raw SVG Icons

If you want to use the raw SVG icons as assets, you can publish them using:

```bash
php artisan vendor:publish --tag=blade-gmdi --force
```

Then use them in your views like:

```blade
<img src="{{ asset('vendor/blade-gmdi/gmdi-1k.svg') }}" width="10" height="10"/>
```

### Blade Icons

Blade Google Material Design Icons uses Blade Icons under the hood. Please refer to [the Blade Icons readme](https://github.com/blade-ui-kit/blade-icons) for additional functionality.

## Changelog

Check out the [CHANGELOG](CHANGELOG.md) in this repository for all the recent changes.

## Maintainers

Blade Google Material Design Icons is developed and maintained by [Swapnil Sarwe](https://swapnilsarwe.com).

## License

Blade Google Material Design Icons is open-sourced software licensed under [the MIT license](LICENSE.md).
