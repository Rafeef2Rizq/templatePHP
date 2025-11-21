<?php

declare(strict_types=1);

namespace Framework;

use Framework\Exceptions\ContainerException;
use ReflectionClass, ReflectionNamedType;

class Container
{
    private array $definitions = [];
    private array $resolved = [];
    public function adDefinitions(array $newDefinitions)
    {
        $this->definitions = [...$this->definitions, ...$newDefinitions];
    }
    public function resolve(string $className)
    {
        $refectionClass = new ReflectionClass($className);
        if (!$refectionClass->isInstantiable()) {
            throw new ContainerException("Class {$className} is not instantiable");
        }
        $constructor = $refectionClass->getConstructor();
        if (!$constructor) {
            return new $className;
        }
        $params = $constructor->getParameters();
        if (count($params) === 0) {
            return new $className;
        }
        $dependencies = [];
        foreach ($params as $param) {
            $name = $param->getName();
            $type = $param->getType();
            if (!$type) {
                throw new ContainerException("Cannot resolve the class {$className} because the parameter \${$name} is missing a type hint");
            }
            if (!$type instanceof ReflectionNamedType || $type->isBuiltin()) {
                throw new ContainerException("Cannot resolve the class {$className} because the parameter \${$name} is not a class");
            }
            $dependencies[] = $this->get($type->getName());
        }
        return $refectionClass->newInstanceArgs($dependencies);
    }
    public function get(string $id)
    {
        if (!array_key_exists($id, $this->definitions)) {
            throw new ContainerException("Class does not exists {$id} in container");
        }
        if (array_key_exists($id, $this->resolved)) {
            return $this->resolved[$id];
        }
        $factory = $this->definitions[$id];
        $depandancy = $factory();
        $this->resolved[$id] = $depandancy;
        return $depandancy;
    }
}
