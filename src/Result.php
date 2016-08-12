<?php

namespace Mbright\TreeExample;

class Result implements NodeInterface
{
    /** @var String */
    protected $display_text;

    /** @param String $display_text */
    public function __construct($display_text)
    {
        $this->display_text = $display_text;
    }

    /** @return String */
    public function getDisplayText()
    {
        return $this->display_text;
    }
}