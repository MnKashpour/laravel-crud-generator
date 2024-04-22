<?php

namespace MnKashpour\LaravelCrudGenerator\Generators;

class RequestGenerator extends BaseGenerator
{
    public function __construct(string $name, protected string $requestSuffix = 'Request')
    {
        parent::__construct($name);
    }

    protected function getViewName(): string
    {
        return 'mnkashpour::model_request';
    }

    protected function getViewVars(): array
    {
        return [
            'namespace' => $this->getFullNamespace(),
            'class' => $this->getClassName(),
        ];
    }

    protected function getBaseNamespace(): string
    {
        return 'App\\Http\\Requests';
    }

    protected function getBasePath(): string
    {
        return 'app' . DIRECTORY_SEPARATOR . 'Http' . DIRECTORY_SEPARATOR . 'Requests';
    }

    protected function getClassName(): string
    {
        return \Str::of(class_basename($this->name))->singular()->studly()->value() . $this->requestSuffix;
    }
}