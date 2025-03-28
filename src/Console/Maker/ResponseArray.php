<?php

namespace Lnext\ServiceFacades\Console\Maker;

use Illuminate\Console\GeneratorCommand;

class ResponseArray extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'utility:responseArray {name} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create trait response array for service salvatory class';

    protected $type = 'ResponseForArray  trait'; // shows up in console

    public function getStub(): string
    {
        return base_path().'/vendor/lnext/service-facades/src/Console/stubs/responseForArray.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return "$rootNamespace/Http/ServiceFacades/Traits";
    }
}
