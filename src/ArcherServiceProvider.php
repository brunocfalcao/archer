<?php

namespace Brunocfalcao\Archer;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Brunocfalcao\Archer\Commands\ArcherCommand;

class ArcherServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('archer')
            ->hasConfigFile()
            ->hasViews('archer')
            ->hasCommand(ArcherCommand::class);
    }
}
