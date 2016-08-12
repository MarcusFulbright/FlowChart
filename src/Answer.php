<?php

namespace Mbright\TreeExample;

class Answer implements NodeInterface
{
    /** @var String */
    protected $display_text;

    /** @var NodeInterface */
    protected $next;

    /**
     * @param $display_text
     * @param NodeInterface $next
     */
    public function __construct($display_text, NodeInterface $next)
    {
        $this->display_text = $display_text;
        $this->next = $next;
    }

    /** @return String */
    public function getDisplayText()
    {
        return $this->display_text;
    }

    /** @return NodeInterface */
    public function getNext()
    {
        return $this->next;
    }
}