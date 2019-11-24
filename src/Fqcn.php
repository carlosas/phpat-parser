<?php

namespace PHPATParser;

class Fqcn
{
    /**
     * @var string
     */
    private $namespace;
    /**
     * @var string
     */
    private $classname;

    public function __construct(
        string $namespace,
        string $classname
    ) {
        $this->namespace = $namespace;
        $this->classname = $classname;
    }

    public function getNamespace(): string
    {
        return $this->namespace;
    }

    public function getClassname(): string
    {
        return $this->classname;
    }
}
