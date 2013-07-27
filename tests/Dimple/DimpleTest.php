<?php

namespace Dimple;

class DimpleTest extends \PHPUnit_Framework_TestCase
{

    public function testSetAndGetSimpleValue()
    {
        $di = new Dimple();

        $di->set('value', 1);

        $this->assertSame(1, $di->get('value'));
    }

    public function testGetValueWithFallback()
    {
        $di = new Dimple();

        $this->assertSame(
            'default',
            $di->get('notset', 'default')
        );
    }

    public function testGetValueThatIsntThere() {
        $di = new Dimple();

        try {

            $di->get('notset');
            $this->fail('Expected UnexpectedValueException to be thrown');

        } catch (\UnexpectedValueException $ex) {
            $this->assertContains('notset', $ex->getMessage());
        }
    }

    public function testGetValueCanDefaultToNull()
    {
        $di = new Dimple();

        $this->assertSame(
            null,
            $di->get('notset', null)
        );
    }

    public function testSetupAndGetDependantValue()
    {
        $di = new Dimple();

        $di->set('config', 'abc');
        $di->setup('complex', function($di) {
            return array('config' => $di->get('config'));
        });

        $this->assertSame(
            array('config' => 'abc'),
            $di->get('complex')
        );
    }

    public function testSetupChainOfDependencies()
    {
        $di = new Dimple();

        $di->set('A', 1);
        $di->setup('B', function($di) {
            return array('A' => $di->get('A'));
        });
        $di->setup('C', function($di) {
            return array('B' => $di->get('B'));
        });

        $this->assertSame(
            array('B' => (array('A' => 1))),
            $di->get('C')
        );
    }

}
