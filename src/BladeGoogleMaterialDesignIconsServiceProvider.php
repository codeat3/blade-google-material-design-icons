<?php

declare(strict_types=1);

namespace Codeat3\BladeGoogleMaterialDesignIcons;

use BladeUI\Icons\Factory;
use Illuminate\Support\ServiceProvider;

final class BladeGoogleMaterialDesignIconsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->callAfterResolving(Factory::class, function (Factory $factory) {
            $factory->add('google-material-design-icons', [
                'path' => __DIR__.'/../resources/svg',
                'prefix' => 'gmdi',
            ]);
        });
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/svg' => public_path('vendor/blade-gmdi'),
            ], 'blade-gmdi');
        }
    }
}
