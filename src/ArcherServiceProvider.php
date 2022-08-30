<?php

namespace Brunocfalcao\Archer;

use Brunocfalcao\Archer\Commands\ArcherCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
