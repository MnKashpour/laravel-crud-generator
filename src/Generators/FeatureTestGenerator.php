<?php

namespace MnKashpour\LaravelCrudGenerator\Generators;

class FeatureTestGenerator extends BaseGenerator
{
    public function __construct(string $name, protected string $fullModelClass, protected string $testSuffix = 'Test')
    {
        parent::__construct($name);
    }

    protected function getViewName(): string
    {
        return 'mnkashpour::feature_test';
    }

    protected function getViewVars(): array
    {
        return [
            'namespace' => $this->getFullNamespace(),
            'class' => $this->getClassName(),
            'fullModelClass' => $this->fullModelClass,
        ];
    }

    protected function getBaseNamespace(): string
    {
        return 'Tests\\Feature';
    }

    protected function getBasePath(): string
    {
        return 'tests' . DIRECTORY_SEPARATOR . 'Feature';
    }

    protected function getClassName(): string
    {
        return \Str::of(class_basename($this->name))->singular()->studly()->value() . $this->testSuffix;
    }
}