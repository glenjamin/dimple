<?php

require_once __DIR__ . '/vendor/autoload.php';

$iterations = 10000000;

class SomethingToMake {
    protected $variable = 'abc';
}

$start = microtime(true);
for ($i = 0; $i < $iterations; ++$i) {
    $s = new SomethingToMake();
}
$raw = microtime(true) - $start;

// Dimple
$di = new Dimple\Dimple();
$di->setup('something', function($di) {
    return new SomethingToMake();
});
$start = microtime(true);
for ($i = 0; $i < $iterations; ++$i) {
    $s = $di->get('something');
}
$dimpled = microtime(true) - $start;

// Pimple
$pimple = new Pimple();
$pimple['something'] = function($c) {
    return new SomethingToMake();
};

$start = microtime(true);
for ($i = 0; $i < $iterations; ++$i) {
    $s = $pimple['something'];
}
$pimpled = microtime(true) - $start;

printf("%d Iterations
Raw: %s
Dimpled: %s
Pimple: %s

Dimple Overhead: %.6f%%
Pimple Overhead: %.6f%%
",
$iterations,
$raw, $dimpled, $pimpled,
(($dimpled - $raw) / $raw) * 100,
(($pimpled - $raw) / $raw) * 100);
