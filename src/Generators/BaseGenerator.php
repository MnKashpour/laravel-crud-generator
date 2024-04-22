<?php

namespace MnKashpour\LaravelCrudGenerator\Generators;

use Illuminate\Filesystem\Filesystem;

abstract class BaseGenerator
{
    readonly public string $name;

    public function __construct(string $name)
    {
        $this->name = collect(explode('/', $name))
            ->map(fn($ele) => str($ele)->singular()->studly()->value())
            ->implode('/');
    }

    public function generate(bool $force = false): self
    {
        $modelClass = $this->getClassName();

        $view = $this->renderView();

        $this->writeFile(
            $this->getDirPath(),
            $modelClass,
            $view,
            $force,
        );

        return $this;
    }

    public function getFullNamespace(): string
    {
        $fileDir = $this->getDirFromPath($this->name);

        if (!$fileDir) {
            return $this->getBaseNamespace();
        }

        return $this->getBaseNamespace() . '\\' . $this->namespaceFromPath($fileDir);
    }

    public function getFullyQualifiedClass(): string
    {
        return $this->getFullNamespace() . '\\' . $this->getClassName();
    }

    protected function renderView(): string
    {
        return view($this->getViewName(), $this->getViewVars())->render();
    }

    protected function writeFile(string $dirPath, string $fileName, string $content, bool $force = false): void
    {
        $dirPath = app()->basePath() . DIRECTORY_SEPARATOR . $dirPath;

        /** @var Filesystem */
        $filesystem = app(Filesystem::class);

        $filesystem->ensureDirectoryExists(
            $dirPath,
        );

        $fileFullPath = $dirPath . DIRECTORY_SEPARATOR . "$fileName.php";

        if (!$force && $filesystem->exists($fileFullPath)) {
            \Log::notice("The file $fileName.php already exists, skipping...");
            return;
        }

        $filesystem->put(
            $fileFullPath,
            '<?php ' . PHP_EOL . PHP_EOL . $content . PHP_EOL,
        );
    }

    protected function getDirPath(): string
    {
        $fileDir = $this->getDirFromPath($this->name);

        if (!$fileDir) {
            return $this->getBasePath();
        }

        return $this->getBasePath() . DIRECTORY_SEPARATOR . $fileDir;
    }

    protected function pathFromNamespace(string $namespace): string
    {
        return collect(explode('\\', $namespace))
            ->map(fn($s) => \Str::studly($s))
            ->implode(DIRECTORY_SEPARATOR);
    }

    protected function namespaceFromPath(string $path): string
    {
        return collect(explode(DIRECTORY_SEPARATOR, $path))
            ->map(fn($s) => \Str::studly($s))
            ->implode('\\');
    }

    protected function getDirFromPath(string $path): string
    {
        if (!str_contains($path, DIRECTORY_SEPARATOR)) {
            return '';
        }

        return pathinfo($path, PATHINFO_DIRNAME);
    }

    abstract protected function getViewName(): string;

    abstract protected function getViewVars(): array;

    abstract protected function getBaseNamespace(): string;

    abstract protected function getBasePath(): string;

    abstract protected function getClassName(): string;
}