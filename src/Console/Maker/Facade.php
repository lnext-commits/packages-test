<?php

namespace Lnext\ServiceFacades\Console\Maker;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class Facade extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'utility:serviceFacade {name} {nameUse} {act} {get} {salvatory}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new static service facade class';

    protected $type = 'ServiceFacade class'; // shows up in console

    public function getStub(): string
    {
        return base_path().'/vendor/lnext/service-facades/src/Console/stubs/serviceFacade.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return "$rootNamespace/Http/ServiceFacades";
    }

    public function replaceClass($stub, $name): array|string
    {
        $name = Str::studly($this->argument('nameUse'));
        $act = $this->argument('act');
        $get = $this->argument('get');
        $salvatory = $this->argument('salvatory');
        $nameClass = 'ServiceFacade'.$name;
        $use = $act ? "use App\Http\ServiceFacades\ActClasses\Act{$name};" : '';
        $use .= $get ? PHP_EOL."use App\Http\ServiceFacades\GetClasses\Get{$name};" : '';
        $use .= $salvatory ? PHP_EOL."use App\Http\ServiceFacades\SalvatoryClasses\Salvatory{$name};" : '';
        $actMethod = $act ? '(new Act'.$name.'())->$method($request);' : '//';
        $getMethod = $get ? 'return (new Get'.$name.'($item))->$method();' : '//';
        $salvatoryMethod = $salvatory ? ' return (new Salvatory'.$name.'())->$method($option, $key);' : '//';

        return str_replace(['DummyClass', 'useDummy', 'actMethod', 'getMethod', 'salvatoryMethod'], [$nameClass, $use, $actMethod, $getMethod, $salvatoryMethod],
            $stub);
    }
}
