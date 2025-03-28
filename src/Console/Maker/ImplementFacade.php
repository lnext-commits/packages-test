<?php

namespace Lnext\ServiceFacades\Console\Maker;

use Illuminate\Console\GeneratorCommand;

class ImplementFacade extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'utility:implementFacade {name} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new FacadeInterface interface for ServiceFacade';

    protected $type = 'FacadeInterface interface'; // shows up in console

    public function getStub(): string
    {
        return base_path().'/vendor/lnext/service-facades/src/Console/stubs/implementFacade.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return "$rootNamespace/Http/ServiceFacades/ServiceInterfaces";
    }
}
