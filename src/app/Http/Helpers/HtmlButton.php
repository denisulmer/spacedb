<?php

namespace SpaceDB\Http\Helpers;

class HtmlButton extends HtmlElement
{
    public $text;
    public $icon;
    public $type;
    public $classes = ['btn', 'waves-effect', 'waves-light'];

    public function __construct($text, $icon, $classes, $type)
    {
        $this->tag = "button";
        $this->type = $type;
        $this->text = $text;
        $this->icon = $icon;
        $this->classes = array_merge($this->classes, $classes);
    }
}