<?php

namespace App\Console\Commands\MakeCommands\Maker;

use Illuminate\Console\GeneratorCommand;

class extendFacade extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'utility:extendFacade {name} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new BaseServiceFacade class for ServiceFacade';

    protected $type = 'BaseServiceFacade class'; // shows up in console

    public function getStub(): string
    {
        return app_path().'/Console/Commands/MakeCommands/stubs/extendFacade.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return "$rootNamespace/Http/ServiceFacades/ParentClasses";
    }
}
