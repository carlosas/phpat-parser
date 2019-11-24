<?php

require __DIR__.'/../vendor/autoload.php';

$code = '
<?php

namespace Tests\PHPATParser;

class SimpleClass {}

$obja = new class() {};
$objb = new class {};

class AnotherClass {}';

$parser = new PHPATParser\FqcnParser();
$definitions = $parser->parse($code);

if (
    count($definitions) !== 2
    || (
        $definitions[0]->getNamespace() !== 'Tests\PHPATParser'
        && $definitions[0]->getClassname() !== 'SimpleClass'
    )
    || (
        $definitions[1]->getNamespace() !== 'Tests\PHPATParser'
        && $definitions[1]->getClassname() !== 'AnotherClass'
    )
) {
    fwrite(\STDERR, 'errors found' . PHP_EOL);
    exit (1);
}

fwrite(\STDOUT, 'tests passed' . PHP_EOL);
exit (0);
