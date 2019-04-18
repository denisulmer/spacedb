<?php

namespace SpaceDB\Http\Helpers;

class HtmlFileInput extends HtmlElement
{
    public $text;
    public $name;
    public $classes = ['btn', 'waves-effect'];

    public function __construct($text, $name, $classes)
    {
        $this->text = $text;
        $this->name == $name;
        $this->classes = array_merge($this->classes, $classes);
    }
}