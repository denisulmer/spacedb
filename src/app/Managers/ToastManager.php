<?php

namespace SpaceDB\Managers;


class ToastManager
{
    /**
     * Flashes a success toast to the session.
     *
     * @param $text
     * @param string $class
     */
    public function success($text, $class = 'success')
    {
        session()->flash('toast', $text);
        session()->flash('toast-class', $class);
    }

    /**
     * Flashes a success toast with undo option to the session.
     *
     * @param $text
     * @param string $class
     */
    public function successUndo($text, $undo, $class = 'success')
    {
        session()->flash('toast', $text);
        session()->flash('toast-class', $class);
        session()->flash('toast-undo', $undo);
    }

    /**
     * Flashes a warning toast to the session.
     *
     * @param $text
     * @param string $class
     */
    public function warning($text, $class = 'warning')
    {
        session()->flash('toast', $text);
        session()->flash('toast-class', $class);
    }

    /**
     * Flashes a error toast to the session.
     *
     * @param $text
     * @param string $class
     */
    public function error($text, $class = 'error')
    {
        session()->flash('toast', $text);
        session()->flash('toast-class', $class);
    }

    /**
     * Flashes a info toast to the session.
     *
     * @param $text
     * @param string $class
     */
    public function info($text, $class = 'info')
    {
        session()->flash('toast', $text);
        session()->flash('toast-class', $class);
    }
}