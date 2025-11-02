<?php

namespace IncadevUns\CoreDomain;

use IncadevUns\CoreDomain\Commands\CoreDomainCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class CoreDomainServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('core-domain')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_core_domain_table')
            ->hasCommand(CoreDomainCommand::class);
    }

    public function registeringPackage(): void
    {
        $this->app->register(\Laravel\Sanctum\SanctumServiceProvider::class);
        $this->app->register(\Spatie\Permission\PermissionServiceProvider::class);
    }
}
