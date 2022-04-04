<?php

declare(strict_types=1);

namespace Codeat3\BladeGoogleMaterialDesignIcons;

use BladeUI\Icons\Factory;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

final class BladeGoogleMaterialDesignIconsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->registerConfig();

        $this->callAfterResolving(Factory::class, function (Factory $factory, Container $container) {
            $config = $container->make('config')->get('blade-google-material-design-icons', []);

            $factory->add('google-material-design-icons', array_merge(['path' => __DIR__ . '/../resources/svg'], $config));
        });
    }

    private function registerConfig(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/blade-google-material-design-icons.php', 'blade-google-material-design-icons');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../resources/svg' => public_path('vendor/blade-google-material-design-icons'),
            ], 'blade-gmdi'); // TODO: updating this alias to `blade-google-material-design-icons` in next major release

            $this->publishes([
                __DIR__ . '/../config/blade-google-material-design-icons.php' => $this->app->configPath('blade-google-material-design-icons.php'),
            ], 'blade-google-material-design-icons-config');
        }
    }
}
