<?php

namespace Brunocfalcao\Archer;

use Illuminate\Support\ServiceProvider;
use Brunocfalcao\Archer\Commands\InstallCommand;
use Brunocfalcao\Archer\Commands\MakeUserCommand;
use Brunocfalcao\Archer\Commands\PintCommand;
use Illuminate\Support\Collection;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

final class ArcherServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerMacros();

        $this->commands([
            InstallCommand::class,
            MakeUserCommand::class,
            PintCommand::class
        ]);

        $this->overrideResources();
    }

    protected function overrideResources()
    {
        $this->publishes([
            __DIR__.'/../resources/overrides/' => base_path('/'),
        ]);
    }

    protected function registerMacros()
    {
        // Include all files from the Macros folder.
        Collection::make(glob(__DIR__.'/Macros/*.php'))
                  ->mapWithKeys(function ($path) {
                      return [$path => pathinfo($path, PATHINFO_FILENAME)];
                  })
                  ->each(function ($macro, $path) {
                      require_once $path;
                  });
    }

    public function register()
    {
        //
    }
}
