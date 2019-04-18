<?php

namespace SpaceDB\Http\Controllers;

use Illuminate\Http\Request;
use SpaceDB\Managers\ToastManager;
use SpaceDB\Manufacturer;

class ManufacturerController extends Controller
{
    public function store(Request $request, ToastManager $toastManager)
    {
        $this->validate($request,[
           'name' => 'required|string'
        ]);

        Manufacturer::create($request->all());
        $toastManager->success(trans('toast.manufacturer-store-success'));

        return redirect()->back();
    }
}
