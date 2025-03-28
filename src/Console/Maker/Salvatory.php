<?php

namespace Lnext\ServiceFacades\Console\Maker;

use Illuminate\Console\GeneratorCommand;

class Salvatory extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'utility:serviceSalvatory {name} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Salvatory class for ServiceFacade';

    protected $type = 'Salvatory class'; // shows up in console

    public function getStub(): string
    {
        return base_path().'vendor/lnext/service-facades/src/Console/stubs/serviceSalvatory.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return "$rootNamespace/Http/ServiceFacades/SalvatoryClasses";
    }
}
