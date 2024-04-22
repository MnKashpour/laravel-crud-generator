<?php

namespace MnKashpour\LaravelCrudGenerator\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use MnKashpour\LaravelCrudGenerator\Generators\ControllerGenerator;
use MnKashpour\LaravelCrudGenerator\Generators\ModelGenerator;
use MnKashpour\LaravelCrudGenerator\Generators\RequestGenerator;
use MnKashpour\LaravelCrudGenerator\Generators\ResourceGenerator;
use MnKashpour\LaravelCrudGenerator\LaravelCrudGenerator;

class GenerateCrudCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:generate {name} {--all} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Crud structure';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $generateAll = $this->option('all') ?? false;
        $forceGenerate = $this->option('force') ?? false;

        $modelGenerator = new ModelGenerator($name);

        if ($generateAll || $this->confirm('Model?', true)) {
            $modelGenerator->generate(force: $forceGenerate);
        }

        do {
            $namespace = $this->anticipate('Namespace', ['Admin', 'Enduser']);

            $resourceGenerator = new ResourceGenerator(
                name: "$namespace\\$name",
                fullModelClass: $modelGenerator->getFullNamespace(),
            );
            $createRequestGenerator = new RequestGenerator("$namespace\\$name", requestSuffix: 'CreateRequest');
            $updateRequestGenerator = new RequestGenerator("$namespace\\$name", requestSuffix: 'UpdateRequest');
            $controllerGenerator = new ControllerGenerator(
                name: "$namespace\\$name",
                fullModelClass: $modelGenerator->getFullNamespace(),
                fullCreateRequestClass: $createRequestGenerator->getFullNamespace(),
                fullUpdateRequestClass: $updateRequestGenerator->getFullNamespace(),
                fullResourceClass: $resourceGenerator->getFullNamespace(),
            );

            if ($generateAll || $this->confirm('Create Request?', true)) {
                $createRequestGenerator->generate(force: $forceGenerate);
            }
            if ($generateAll || $this->confirm('Update Request?', true)) {
                $updateRequestGenerator->generate(force: $forceGenerate);
            }
            if ($generateAll || $this->confirm('Resource?', true)) {
                $resourceGenerator->generate(force: $forceGenerate);
            }
            if ($generateAll || $this->confirm('Controller?', true)) {
                $controllerGenerator->generate(force: $forceGenerate);
            }
        } while ($this->confirm('Another Namespace?'));
    }
}
