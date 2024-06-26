<?php

namespace LaravelAngular\Generators\Console\Commands;

use File;
use Illuminate\Console\Command;

class AngularCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ng:command {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new command in server';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');
        $studly_name = studly_case($name);
        $upperCaseName = strtoupper($name);

        // Get Stub file
        $stubCommand = file_get_contents(__DIR__.'/Stubs/AngularCommand/command.php.stub');
        $stubService = file_get_contents(__DIR__.'/Stubs/AngularCommand/service.php.stub');

        // Replace text
        $stubCommand = str_replace('{{StudlyName}}', $studly_name, $stubCommand);
        $stubCommand = str_replace('{{name}}', $name, $stubCommand);
        $stubCommand = str_replace('{{UpperCaseName}}', $upperCaseName, $stubCommand);

        $stubService = str_replace('{{StudlyName}}', $studly_name, $stubService);
        $stubService = str_replace('{{name}}', $name, $stubService);

        // Create folder
        $folderCommand = base_path(config('generators.php.command'));
        $folderService = base_path(config('generators.php.service'));

        $this->createDirIfNotExist($folderCommand);
        $this->createDirIfNotExist($folderService);

        // Create file
        // ${studly_name}Command.php file
        File::put($folderCommand.'/'.$studly_name.'Command.php', $stubCommand);
        // ${name}Service.php file
        File::put($folderService.'/'.$name.'.service.php', $stubService);

        $this->info('Component Command created successfully.');
    }

    private function createDirIfNotExist($folder) {
        if (is_dir($folder)) {
            return;
        }

        File::makeDirectory($folder, 0775, true);
    }
}
