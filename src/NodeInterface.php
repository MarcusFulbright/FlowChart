<?php

namespace Mbright\TreeExample;

interface NodeInterface
{
    /** Should return text that is safe to display to the user */
    public function getDisplayText();
}