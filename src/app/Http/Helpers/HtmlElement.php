<?php

namespace SpaceDB\Http\Helpers;

class HtmlElement
{
    public $tag;
    public $properties;
    public $classes = [];

    public function __construct($tag)
    {
        $this->tag = $tag;
    }

    public static function Input($type, $name, $classes = [], $value = '')
    {
        $element = new HtmlInput($type, $name, $classes, $value);
        return view('html.input', compact('element'));
    }

    public static function Label($for, $text, $classes = [])
    {
        $element = new HtmlLabel($for, $text, $classes);
        return view('html.label', compact('element'));
    }

    public static function Submit($text, $icon, $classes = [])
    {
        $element = new HtmlButton($text, $icon, $classes, 'submit');
        return view('html.button', compact('element'));
    }

    public static function File($name, $text, $classes = [])
    {
        $element = new HtmlFileInput($text, $name, $classes);
        return view('html.file', compact('element'));
    }

    public static function TextArea($name, $classes = [])
    {
        $element = new HtmlTextArea($name, $classes);
        return view('html.text-area', compact('element'));
    }
}

