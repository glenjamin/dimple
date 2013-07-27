<?php

namespace Dimple;

class Dimple {

    private $values = array();
    private $factories = array();

    /**
     * Set a constant
     *
     * @param string $key   [description]
     * @param mixed  $value Any value that doesn't
     */
    public function set($key, $value) {
        $this->values[$key] = $value;
    }

    public function setup($key, \Closure $factory) {
        $this->factories[$key] = $factory;
    }

    public function get($key, $default = 'ihopeyoudontwantopassthisvalue') {
        if (isset($this->values[$key])) {
            return $this->values[$key];
        }
        if (isset($this->factories[$key])) {
            $factory = $this->factories[$key];
            return $factory($this);
        }
        if ($default !== 'ihopeyoudontwantopassthisvalue') {
            return $default;
        }
        throw new \UnexpectedValueException("'$key' is not defined");
    }

}
