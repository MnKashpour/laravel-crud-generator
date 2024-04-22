<?php

namespace MnKashpour\LaravelCrudGenerator\Generators;

class ControllerGenerator extends BaseGenerator
{
    public function __construct(
        string $name,
        protected string $fullModelClass,
        protected string $fullCreateRequestClass,
        protected string $fullUpdateRequestClass,
        protected string $fullResourceClass,
        protected string $controllerSuffix = 'Controller',
    ) {
        parent::__construct($name);
    }

    protected function getViewName(): string
    {
        return 'mnkashpour::model_controller';
    }

    protected function getViewVars(): array
    {
        return [
            'namespace' => $this->getFullNamespace(),
            'class' => $this->getClassName(),
            'fullModelClass' => $this->fullModelClass,
            'fullCreateRequestClass' => $this->fullCreateRequestClass,
            'fullUpdateRequestClass' => $this->fullUpdateRequestClass,
            'fullResourceClass' => $this->fullResourceClass,
            'model' => class_basename($this->fullModelClass),
        ];
    }

    protected function getBaseNamespace(): string
    {
        return 'App\\Http\\Controllers';
    }

    protected function getBasePath(): string
    {
        return 'app' . DIRECTORY_SEPARATOR . 'Http' . DIRECTORY_SEPARATOR . 'Controllers';
    }

    protected function getClassName(): string
    {
        return \Str::of(class_basename($this->name))->singular()->studly()->value() . $this->controllerSuffix;
    }
}