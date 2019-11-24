<?php

require __DIR__.'/vendor/autoload.php';

if (PHP_VERSION_ID < 70100) {
    \fwrite(\STDERR, 'Required at least PHP version 7.1.0 but your version is '.PHP_VERSION.PHP_EOL);
    exit(1);
}

$code = '
<?php

namespace Tests\PhpAT\functional\PHP7\fixtures;

class SimpleClass
{
}

class AnotherClass
{
}
";';

$parser = new PHPATParser\Parser();
$definitions = $parser->parse($code);

foreach ($definitions as $definition) {
    echo $definition->getNamespace() . '\\' . $definition->getClassname() . PHP_EOL;
}
