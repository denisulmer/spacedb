<?php

namespace SpaceDB\Http\Helpers;

class HtmlInput extends HtmlElement
{
    public $name;
    public $placeholder;
    public $value;
    public $type;

    public function __construct($type, $name, $classes, $value)
    {
        $this->tag = "input";
        $this->type = $type;
        $this->name = $name;
        $this->classes = array_merge($this->classes, $classes);
        $this->value = $value;
        $this->placeholder = "";
    }
}