<?php

namespace App\Console\Commands\MakeCommands\Maker;

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
        return app_path().'/Console/Commands/MakeCommands/stubs/serviceGet.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return "$rootNamespace/Http/ServiceFacades/GetClasses";
    }
}
