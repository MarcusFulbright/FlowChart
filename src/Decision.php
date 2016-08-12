<?php

namespace Mbright\TreeExample;

class Decision implements NodeInterface
{
    /** @var String */
    protected $display_text;

    /** @var array[NodeInterface] */
    protected $answers = [];

    /**
     * @param $display_text
     * @param array[NodeInterface] $answers
     */
    public function __construct($display_text, $answers = [])
    {
        $this->display_text = $display_text;
        foreach ($answers as $answer) {
            $this->addAnswer($answer);
        }
    }

    /** @param Answer $answer */
    public function addAnswer(Answer $answer)
    {
        $this->answers[$answer->getDisplayText()] = $answer;
    }

    /** @param $answer */
    public function removeAnswer($answer)
    {
        unset($this->answers[$answer]);
    }

    /** @return String */
    public function getDisplayText()
    {
        return $this->display_text;
    }

    /**
     * @param String $input
     * @return NodeInterface
     */
    public function getAnswer($input)
    {
        return $this->answers[$input];
    }
}