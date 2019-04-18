<?php

namespace SpaceDB\Http\Helpers;

class HtmlLabel extends HtmlElement
{
    public $for;
    public $text;

    public function __construct($for, $text, $classes)
    {
        $this->tag = "label";
        $this->for = $for;
        $this->text = $text;
        $this->classes = array_merge($this->classes, $classes);
    }
}