<?php

namespace SpaceDB\Http\Helpers;

class HtmlTextArea extends HtmlElement
{
    public $name;
    public $placeholder;
    public $classes = ['materialize-textarea', 'validate'];

    public function __construct($name, $classes, $placeholder = '')
    {
        $this->tag = "textarea";
        $this->name = $name;
        $this->classes = array_merge($this->classes, $classes);
        $this->placeholder = $placeholder;
    }
}
