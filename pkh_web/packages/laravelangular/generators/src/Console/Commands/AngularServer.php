<?php

namespace LaravelAngular\Generators\Console\Commands;

use File;
use Illuminate\Console\Command;

class AngularServer extends Command
{
    /**
     * The name and signature of the console command.
     * - template=list|create
     *
     * @var string
     */
    protected $signature = 'ng:server {name} 
        {--template= : List template}
        {--class-model= : Class model}
        {--table-name= : table name}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new component in server';

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
        $ng_component = str_replace('_', '-', $name);

        $modelClass = !$this->option('class-model') ? "MyModelClass" : $this->option('class-model');
        $tableName = !$this->option('table-name') ? "MyTableName" : $this->option('table-name');
        $this->info(" - modelClass: ". $modelClass);
        $this->info(" - tableName: ". $tableName);

        // //import component
        // $components_index = base_path(config('generators.source.root')).'/index.components.js';
        // if (config('generators.misc.auto_import') && !$this->option('no-import') && file_exists($components_index)) {
        //     $components = file_get_contents($components_index);
        //     $componentName = lcfirst($studly_name);
        //     $newComponent = "\r\n\t.component('$componentName', {$studly_name}Component)";
        //     $module = "angular.module('app.components')";
        //     $components = str_replace($module, $module.$newComponent, $components);
        //     $components = 'import {'.$studly_name."Component} from './app/components/{$name}/{$name}.component';\n".$components;
        //     file_put_contents($components_index, $components);
        // }

        // Get Stub file
        $stubController = file_get_contents(__DIR__.'/Stubs/AngularServer/controller.php.stub');
        $stubService = file_get_contents(__DIR__.'/Stubs/AngularServer/service.php.stub');
        $stubView = file_get_contents(__DIR__.'/Stubs/AngularServer/view.php.stub');

        if( $this->option("template")) {
            $template = $this->option("template");
            $this->info(' - Template: ' . $template);
            if( $template == "list" || $template == "create") {
                // $stubController = file_get_contents(__DIR__.'/Stubs/AngularServer/list.controller.php.stub');
                // $stubService = file_get_contents(__DIR__.'/Stubs/AngularServer/list.service.php.stub');
                // $stubView = file_get_contents(__DIR__.'/Stubs/AngularServer/list.view.php.stub');
                $stubController = file_get_contents(__DIR__ . "/Stubs/AngularServer/$template.controller.php.stub");
                $stubService = file_get_contents(__DIR__ . "/Stubs/AngularServer/$template.service.php.stub");
                $stubView = file_get_contents(__DIR__ . "/Stubs/AngularServer/$template.view.php.stub");
            }
        }

        // Replace text
        $stubController = str_replace('{{StudlyName}}', $studly_name, $stubController);
        $stubController = str_replace('{{name}}', $name, $stubController);

        $stubService = str_replace('{{StudlyName}}', $studly_name, $stubService);
        $stubService = str_replace('{{name}}', $name, $stubService);
        $stubService = str_replace('{{modelClass}}', $modelClass, $stubService);
        $stubService = str_replace('{{tableName}}', $tableName, $stubService);

        $stubView = str_replace('{{StudlyName}}', $studly_name, $stubView);
        $stubView = str_replace('{{name}}', $name, $stubView);

        // Create folder
        $folderController = base_path(config('generators.php.controller'));
        $folderService = base_path(config('generators.php.service'));
        $folderView = base_path(config('generators.php.view'));

        $this->createDirIfNotExist($folderController);
        $this->createDirIfNotExist($folderService);
        $this->createDirIfNotExist($folderView);

        // Create file
        // ${studly_name}Controller.php file
        File::put($folderController.'/'.$studly_name.'Controller.php', $stubController);
        // ${studly_name}Service.php file
        File::put($folderService.'/'.$studly_name.'Service.php', $stubService);
        // ${name}Service.php file
        File::put($folderView.'/'.$name.'.blade.php', $stubView);

        $this->info('Component Server created successfully.');
    }

    private function createDirIfNotExist($folder) {
        if (is_dir($folder)) {
            return;
        }

        File::makeDirectory($folder, 0775, true);
    }
}
