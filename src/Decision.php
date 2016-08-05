<?php

namespace Mbright\TreeExample;

class Decision implements NodeInterface
{
    protected $prompt;

    protected $children = [];

    public function __construct($prompt, $children = [])
    {
        $this->prompt = $prompt;
        $this->children = $children;
    }

    public function addChild($result, NodeInterface $child)
    {
        $this->children[$result] = $child;
    }

    public function removeChild($result)
    {
        unset($this[$result]);
    }

    public function getChild($result)
    {
        return $this->children[$result];
    }

    public function getPrompt()
    {
        return $this->prompt;
    }

    public function hasChildren()
    {
        return count($this->children) > 0;
    }
}