<?php

namespace App\Console\Commands\MakeCommands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeServiceFacade extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:services
                    {name? : name service class ServiceFacadeName}
                    {-- all : creating all the necessary classes }
                    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Service Facade classes';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->argument('name') === null) {
            $name = $this->ask('enter the name of the service');
        } else {
            $name = $this->argument('name');
        }

        $nameClass = 'ServiceFacade'.Str::studly($name);
        $all = $this->option('all');

        if ($all) {
            $actClass = $getClass = $salvatoryClass = true;
        } else {
            $this->newLine();
            $this->info('creating classes for your facade '.$nameClass);
            $actClass = $this->confirm("create Act class?", true);
            $getClass = $this->confirm("create Get class?", true);
            $salvatoryClass = $this->confirm("create Salvatory class?", true);
        }

        if ($actClass) {
            $this->call('utility:serviceAct', [
                'name' => 'Act'.Str::studly($name),
            ]);
        }

        if ($getClass) {
            $this->call('utility:serviceGet', [
                'name' => 'Get'.Str::studly($name),
            ]);
        }

        if ($salvatoryClass) {
            $this->call('utility:serviceSalvatory', [
                'name' => 'Salvatory'.Str::studly($name),
            ]);
        }

        $this->call('utility:serviceFacade', [
            'name' => $nameClass,
            'nameUse' => $name,
            'act' => $actClass,
            'get' => $getClass,
            'salvatory' => $salvatoryClass,
        ]);

        if (!class_exists('App\Http\ServiceFacades\ParentClasses\BaseServiceFacade')) {
            $this->call('utility:extendFacade', [
                'name' => 'BaseServiceFacade',
            ]);
        }

        if (!trait_exists('App\Http\ServiceFacades\Traits\ResponseForArray')) {
            $this->call('utility:responseArray', [
                'name' => 'ResponseForArray',
            ]);
        }

        $this->newLine(2);
        $this->alert('classes created!!');

        return 0;
    }
}
