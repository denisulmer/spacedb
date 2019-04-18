<?php

namespace SpaceDB\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use SpaceDB\Managers\ToastManager;
use SpaceDB\User;

class UserController extends Controller
{
    public function gallery(User $user)
    {
        $images = $user->images;
        return view('pages.user.gallery', compact('images'));
    }

    public function standardEquipment()
    {
        return view('pages.user.standard-equipment', ['user' => auth()->user()]);
    }

    public function updateStandardEquipment(Request $request, ToastManager $toastManager)
    {
        $user = auth()->user();

        // Update optics
        $standardOptics = [];
        if ($request->has('standard-optics')) {
            $standardOptics = array_values($request->toArray()['standard-optics']);
        }
        foreach ($user->optics as $optics) {
            $user->optics()->updateExistingPivot($optics->id, ['is_standard' => (int)in_array($optics->id, $standardOptics)]);
        }

        // Update mounts
        $standardMounts = [];
        if ($request->has('standard-mounts')) {
            $standardMounts = array_values($request->toArray()['standard-mounts']);
        }
        foreach ($user->mounts as $mount) {
            $user->mounts()->updateExistingPivot($mount->id, ['is_standard' => (int)in_array($mount->id, $standardMounts)]);
        }

        // Update cameras
        $standardCameras = [];
        if ($request->has('standard-cameras')) {
            $standardCameras = array_values($request->toArray()['standard-cameras']);
        }
        foreach ($user->cameras as $camera) {
            $user->cameras()->updateExistingPivot($camera->id, ['is_standard' => (int)in_array($camera->id, $standardCameras)]);
        }

        $toastManager->success(trans('toast.update-equipment-success'));

        return redirect()->back();
    }
}
