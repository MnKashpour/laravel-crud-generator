<?php

namespace MnKashpour\LaravelCrudGenerator\Generators;

class ModelGenerator extends BaseGenerator
{
    public function __construct(string $name, protected bool $generateMigration = true, protected bool $generateFactory = true, )
    {
        parent::__construct($name);
    }

    public function generate(bool $force = false): self
    {
        parent::generate($force);

        if ($this->generateMigration) {
            $this->generateModelMigration();
        }

        if ($this->generateFactory) {
            $this->generateModelFactory();
        }

        return $this;
    }

    protected function generateModelMigration()
    {
        $table = \Str::snake(\Str::pluralStudly(class_basename($this->name)));

        \Artisan::call('make:migration', [
            'name' => "create_{$table}_table",
            '--create' => $table,
        ]);
    }

    protected function generateModelFactory()
    {
        $table = \Str::snake(\Str::pluralStudly(class_basename($this->name)));

        \Artisan::call('make:factory', [
            'name' => $this->name . 'Factory',
            '--model' => $this->name,
        ]);
    }

    protected function getViewName(): string
    {
        return 'mnkashpour::model';
    }

    protected function getViewVars(): array
    {
        return [
            'namespace' => $this->getFullNamespace(),
            'class' => $this->getClassName(),
            'includeActivity' => config('laravel-crud-generator.include_activity_log'),
        ];
    }

    protected function getBaseNamespace(): string
    {
        return 'App\\Models';
    }

    protected function getBasePath(): string
    {
        return 'app' . DIRECTORY_SEPARATOR . 'Models';
    }

    protected function getClassName(): string
    {
        return \Str::of(class_basename($this->name))->singular()->studly()->value();
    }
}