<?php

namespace Brunocfalcao\Archer;

use Brunocfalcao\Archer\Commands\ArcherCommand;
use Brunocfalcao\Archer\Commands\PintCommand;
use Illuminate\Support\Facades\Blade;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ArcherServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('archer')
            ->hasConfigFile()
            ->hasCommand(PintCommand::class);
    }
}
