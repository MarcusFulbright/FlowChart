<?php

namespace Mbright\TreeExample;

class Chart
{
    /** @var NodeInterface */
    public $current;

    /** @var Decision */
    public $root;

    /**
     * @param Decision $root
     */
    public function __construct(Decision $root)
    {
        $this->root = $root;
        $this->current = $root;
    }

    /** @param String */
    public function next($input)
    {
        if ($this->atResult()) {
            //@todo throw exception here?
            return false;
        }

        $this->current = $this->current->getAnswer($input)->getNext();
        return $this->current;
    }

    /** @return bool */
    public function atResult()
    {
        return $this->current instanceof Result;
    }
}