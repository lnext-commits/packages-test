<?php

namespace Lnext\ServiceFacades\Console\Maker;

use Illuminate\Console\GeneratorCommand;

class Get extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'utility:serviceGet {name} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Get class for ServiceFacade';

    protected $type = 'Get class'; // shows up in console

    public function getStub(): string
    {
        return base_path().'/vendor/lnext/service-facades/src/Console/stubs/serviceGet.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return "$rootNamespace/Http/ServiceFacades/GetClasses";
    }
}
