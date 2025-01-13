<?php

namespace InfinityXTech\FilamentWorldMapWidget\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Support\Str;

class FilamentWorldMapWidgetCommand extends GeneratorCommand
{
    protected $name = 'make:filament-map-widget';
    protected $description = 'Create a filament map widget';
    protected $type = 'Map Widget';

    protected function getStub()
    {
        return __DIR__ . '/../../stubs/map.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Filament\Widgets';
    }

    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the widget class'],
        ];
    }

    protected function buildClass($name)
    {
        $stub = file_get_contents($this->getStub());

        // Determine the namespace and class name
        $namespace = $this->getDefaultNamespace(trim($this->rootNamespace(), '\\'));
        $className = Str::studly($this->argument('name'));

        // Replace placeholders in the stub
        $stub = str_replace(
            ['{{ namespace }}', '{{ class }}'],
            [$namespace, $className],
            $stub
        );

        return $stub;
    }

    protected function replaceClass($stub, $name)
    {
        return str_replace('{{ class }}', $name, $stub);
    }

    protected function getPath($name)
    {
        // Define the path where the widget will be created
        $name = Str::studly($name);
        return app_path("Filament/Widgets/{$name}.php");
    }

    public function handle()
    {
        $name = $this->argument('name');
        $path = $this->getPath($name);
        
        // Check if the file already exists
        if (File::exists($path)) {
            $this->error("The widget class {$name} already exists.");
            return false;
        }

        // Generate the class content and write to the file
        $this->makeDirectory($path);
        file_put_contents($path, $this->buildClass($name));

        $this->info("Widget class {$name} created successfully at {$path}");
        return true;
    }
}
