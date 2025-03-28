<?php

namespace Lnext\ServiceFacades;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Lnext\ServiceFacades\Console\Maker\extendFacade;
use Lnext\ServiceFacades\Console\Maker\Facade;
use Lnext\ServiceFacades\Console\Maker\FacadeSingleton;
use Lnext\ServiceFacades\Console\Maker\Get;
use Lnext\ServiceFacades\Console\Maker\ImplementFacade;
use Lnext\ServiceFacades\Console\Maker\OwnSeeder;
use Lnext\ServiceFacades\Console\Maker\ResponseArray;
use Lnext\ServiceFacades\Console\Maker\Salvatory;
use Lnext\ServiceFacades\Console\Maker\SingletonArrayBoxClass;
use Lnext\ServiceFacades\Console\Maker\SingletonClass;
use Lnext\ServiceFacades\Console\MakeServiceFacade;
use Lnext\ServiceFacades\Console\Singleton;
use Lnext\ServiceFacades\Console\Maker\Act;

class ServiceFacadesProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot(): void
    {
       //
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->commands(
            [
                MakeServiceFacade::class,
                Singleton::class,
                Act::class,
                ExtendFacade::class,
                Facade::class,
                FacadeSingleton::class,
                Get::class,
                ImplementFacade::class,
                OwnSeeder::class,
                ResponseArray::class,
                Salvatory::class,
                SingletonArrayBoxClass::class,
                SingletonClass::class,
            ]
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [
            MakeServiceFacade::class,
            Singleton::class,
            Act::class,
            ExtendFacade::class,
            Facade::class,
            FacadeSingleton::class,
            Get::class,
            ImplementFacade::class,
            OwnSeeder::class,
            ResponseArray::class,
            Salvatory::class,
            SingletonArrayBoxClass::class,
            SingletonClass::class,
        ];
    }
}
