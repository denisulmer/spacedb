<?php

namespace SpaceDB\Http\Controllers;

use Illuminate\Http\Request;
use SpaceDB\Image;

class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function start()
    {
        $images = Image::orderByDesc('created_at')->get();
        return view('pages.static.start', compact('images'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function discover()
    {
        return view('pages.static.discover');
    }
}
