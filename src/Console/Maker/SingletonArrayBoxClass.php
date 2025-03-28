<?php

namespace App\Console\Commands\MakeCommands\Maker;

use Illuminate\Console\GeneratorCommand;

class SingletonArrayBoxClass extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'utility:SingletonArrayBox  {name : default SingletonArrayBox}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new SingletonArrayBox class';

    protected $type = 'SingletonArrayBox class'; // shows up in console

    public function getStub(): string
    {
        return app_path().'/Console/Commands/MakeCommands/stubs/singletonArrayBox.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return "$rootNamespace/Singletons/Parent";
    }
}
