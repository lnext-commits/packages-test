<?php

namespace Lnext\ServiceFacades\Console\Maker;

use Illuminate\Console\GeneratorCommand;

class Act extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'utility:serviceAct {name} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Act class for ServiceFacade';

    protected $type = 'Act class'; // shows up in console

    public function getStub(): string
    {
        return base_path().'/vendor/lnext/service-facades/src/Console/stubs/serviceAct.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return "$rootNamespace/Http/ServiceFacades/ActClasses";
    }

}
