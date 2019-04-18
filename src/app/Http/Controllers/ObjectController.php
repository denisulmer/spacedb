<?php

namespace SpaceDB\Http\Controllers;

use Illuminate\Http\Request;
use SpaceDB\Object;

class ObjectController extends Controller
{
    public function show(Object $object)
    {
        return view('pages.object.show', compact('object'));
    }
}
