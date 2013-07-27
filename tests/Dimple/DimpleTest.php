<?php

namespace Dimple;

class DimpleTest extends \PHPUnit_Framework_TestCase
{

    public function testSetAndGetSimpleValue()
    {
        $di = new Dimple();

        $di->set('value', 1);

        $this->assertEquals(1, $di->get('value'));
    }

}
