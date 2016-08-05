<?php

namespace Mbright\TreeExample;

class Chart
{
    /** @var NodeInterface */
    public $current;

    public $root;

    public function __construct(Decision $root)
    {
        $this->root = $root;
        $this->current = $root;
    }

    public function next($input)
    {
        if ($this->atResult()) {
            //@todo throw exception here?
            return false;
        }

        $this->current = $this->current->getChild($input);
        return $this->current;
    }

    public function atResult()
    {
        return $this->current instanceof Result;
    }
}