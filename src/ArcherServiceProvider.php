<?php

namespace Brunocfalcao\Archer;

use Brunocfalcao\Archer\Commands\InstallCommand;
use Brunocfalcao\Archer\Commands\MakeUserCommand;
use Brunocfalcao\Archer\Commands\PintCommand;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

final class ArcherServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerMacros();

        $this->commands([
            InstallCommand::class,
            MakeUserCommand::class,
            PintCommand::class,
            //ImportCsvCommand::class
        ]);

        $this->overrideResources();
        $this->loadCustomDirectives();
    }

    protected function loadCustomDirectives()
    {
        /**
         * The @foreach is a bit slow, lets have a loop just for the straight
         * foreach php function loop.
         * https://laravel-news.com/faster-laravel-optimizations.
         */
        Blade::directive('loop', function ($expression) {
            return "<?php foreach ($expression): ?>";
        });

        Blade::directive('endloop', function ($expression) {
            return '<?php endforeach; ?>';
        });
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
