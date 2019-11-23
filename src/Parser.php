<?php

namespace PHPATParser;

class Parser
{
    private $lastTokenType = '';
    private $namespace = '';
    private $classname = '';

    public function parse(string $code): ClassDefinition
    {
        $tokens = token_get_all($code);

        foreach ($tokens as $token) {
            if (is_array($token)) {
                $this->proccess($token);
            }
        }

        $definition = new ClassDefinition(
            $this->namespace,
            $this->classname
        );

        return $definition;
    }

    private function proccess(array $token)
    {
        $currentTokenName = token_name($token[0]);

        if ($currentTokenName === 'T_WHITESPACE') {
            return;
        }

        switch ($this->lastTokenType) {
            case 'T_NAMESPACE':
                if ($currentTokenName === 'T_NS_SEPARATOR' || $currentTokenName === 'T_STRING') {
                    $this->namespace .= $token[1];
                    return;
                }
                break;
            case 'T_CLASS':
                $this->classname = $token[1];
        }

        $this->lastTokenType = token_name($token[0]);
    }
}
