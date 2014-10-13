<?php


namespace Payroll;


class Collection implements \Iterator, \Countable
{

    protected $objects = array();
    protected $currentKey = 0;

    public function current()
    {
        if (array_key_exists($this->currentKey, $this->objects)) {
            return $this->objects[$this->currentKey];
        }
        return false;
    }

    public function add($object)
    {
        $this->objects[] = $object;
    }

    public function remove($key)
    {
        if (array_key_exists($key, $this->objects)) {
            unset($this->objects[$key]);
        }
    }

    public function next()
    {
        $this->currentKey += 1;
    }

    public function key()
    {
        return $this->currentKey;
    }

    public function valid()
    {
        if (array_key_exists($this->currentKey, $this->objects)) {
            return true;
        }
        return false;
    }

    public function rewind()
    {
        $this->objects = array_values($this->objects);
        $this->currentKey = 0;
    }

    public function count()
    {
        return count($this->objects);
    }
}
