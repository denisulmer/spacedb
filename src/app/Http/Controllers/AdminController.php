<?php

namespace SpaceDB\Http\Controllers;

use Illuminate\Http\Request;
use SpaceDB\Manufacturer;

class AdminController extends Controller
{
    public function showManufacturerDatabase()
    {
        $manufacturers = Manufacturer::all();
        return view('admin.database.manufacturer', compact('manufacturers'));
    }
}
