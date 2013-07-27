# Dimple

Dirt simple dependency injection container based loosely on Pimple

## Install

    composer require dimple/dimple

## Usage

```php
$di = new \Dimple\Dimple();

$di->setup('app', function($di) {
    return new Application($di->get('db'), $di->get('logger'));
});

$di->setup('db', function($di) {
    return new \PDO($di->get('db-string'));
});

$di->set('dbstring', 'mysql://localhost');
$di->setup('logger', function($di) {
    return new Logger($di->get('logfile', '/dev/null'));
});

$app = $di->get('app');
$app->run();
```

## How do I return the same instance on subsequent calls?

You don't.

## Is it fast?

Unfortunately not massively, although it's not *too* bad

```
> php benchmark.php
10000000 Iterations
Raw: 4.3745291233063
Dimpled: 14.07391500473

Overhead: 221.724113%
```

It's a little over two times slower than raw object initialisation.
If you use it for only your service level objects it should be palatable.
