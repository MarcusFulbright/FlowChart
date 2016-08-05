<?php

namespace Mbright\TreeExample;

class Result implements NodeInterface
{
    public $result;

    public function __construct($result)
    {
        $this->result = $result;
    }

    public function hasChildren()
    {
        return false;
    }

    public function isRoot()
    {
        return false;
    }
}