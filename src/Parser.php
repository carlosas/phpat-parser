<?php

namespace PHPATParser;

class Parser
{
    private $lastTokenType = '';
    private $namespace = '';
    private $classname = '';
    private $classesFound = [];

    /**
     * @param string $code
     * @return ClassDefinition[]
     */
    public function parse(string $code): array
    {
        $tokens = token_get_all($code);

        foreach ($tokens as $token) {
            $this->proccess($token);
        }

        return $this->classesFound;
    }

    private function proccess($token)
    {
        if (!is_array($token)) {
            return;
        }

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
                $this->classesFound[] = new ClassDefinition($this->namespace, $this->classname);
        }

        $this->lastTokenType = token_name($token[0]);
    }
}
