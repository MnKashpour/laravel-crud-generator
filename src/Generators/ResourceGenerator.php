<?php

namespace MnKashpour\LaravelCrudGenerator\Generators;

class ResourceGenerator extends BaseGenerator
{
    public function __construct(
        string $name,
        protected string $fullModelClass,
        protected string $resourceSuffix = 'Resource',
    ) {
        parent::__construct($name);
    }

    protected function getViewName(): string
    {
        return 'mnkashpour::model_resource';
    }

    protected function getViewVars(): array
    {
        return [
            'namespace' => $this->getFullNamespace(),
            'class' => $this->getClassName(),
            'fullModelClass' => $this->fullModelClass
        ];
    }

    protected function getBaseNamespace(): string
    {
        return 'App\\Http\\Resources';
    }

    protected function getBasePath(): string
    {
        return 'app' . DIRECTORY_SEPARATOR . 'Http' . DIRECTORY_SEPARATOR . 'Resources';
    }

    protected function getClassName(): string
    {
        return \Str::of(class_basename($this->name))->singular()->studly()->value() . $this->resourceSuffix;
    }
}