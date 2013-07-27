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
