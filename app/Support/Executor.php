<?php

namespace App\Support;

class Executor
{
    public function run(string $namespace, string $class, ...$args)
    {
        $classNamespace = "\\App\\Actions\\{$namespace}\\{$class}";
        $class = $this->resolveClass($classNamespace);

        return $class->execute(...$args);
    }

    private function resolveClass(string $classNamespace)
    {
        $this->checkClassExists($classNamespace);

        return new $classNamespace;
    }

    private function checkClassExists(string $classNamespace): void
    {
        if (!class_exists($classNamespace)) {
            throw new \Exception("{$classNamespace} not found.");
        }
    }
}
