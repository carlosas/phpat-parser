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
";';

$parser = new PHPATParser\Parser();
$definition = $parser->parse($code);

echo $definition->getNamespace() . '\\' . $definition->getClassname() . PHP_EOL;
