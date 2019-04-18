<?php

namespace SpaceDB\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image as Intervention;
use SpaceDB\AstrometryJob;
use SpaceDB\Camera;
use SpaceDB\Events\Image\ImageUploaded;
use SpaceDB\Image;
use SpaceDB\Managers\ToastManager;
use SpaceDB\Mount;
use SpaceDB\Optics;
use SpaceDB\User;

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::all();
        return view('pages.image.index', compact('images'));
    }

    public function create()
    {
        $allOptics = Optics::all();
        $cameras = Camera::all();
        return view('pages.image.create', compact('allOptics', 'cameras'));
    }

    public function store(Request $request, ToastManager $toastManager)
    {
        $user = auth()->user();
        Log::debug('Request for storing new image by user #' . $user->id . ' (' . $user->name . '/' . $user->email . ')');

        // Request validation
        $this->validate($request, [
            'name' => 'required|string|max:60',
            'description' => 'required|string|max:3000',
            'image-file' => 'required|mimes:jpeg,png,gif',
            'optics' => 'required|array',
            'mounts' => 'required|array',
            'cameras' => 'required|array'
        ]);

        // Variables
        $filename = uniqid() . time() . md5($request->get('name'));

        // Begin new database transaction to guarantee consistent state
        DB::beginTransaction();
        try {
            $imageInstance = Intervention::make($request->file('image-file'));
            $mimeType = $imageInstance->mime();
            $sizeBytes = $imageInstance->filesize();
            Log::debug('The image mime-type is ' . $mimeType . ' and it is ' . $sizeBytes . ' bytes');

            # TODO: Check Quota

            $request->file('image-file')->move(storage_path('app/images'), $filename);

            $image = Image::create([
                'user_id' => $user->id,
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'height' => $imageInstance->height(),
                'width' => $imageInstance->width(),
                'filename' => $filename,
                'mime_type' => $mimeType,
                'bytes' => $sizeBytes
            ]);

            // Make a new astrometry job for the uploaded image
            $astrometryJob = AstrometryJob::create([
                'image_id' => $image->id,
                'status' => 'pending_submission'
            ]);

            // Make pivot Connections
            foreach($request->get('optics') as $optics) {
                $image->optics()->attach($optics);
            }
            foreach($request->get('mounts') as $mount) {
                $image->mounts()->attach($mount);
            }
            foreach($request->get('cameras') as $camera) {
                $image->cameras()->attach($camera);
            }

            // Fire event for uploaded image
            event(new ImageUploaded($astrometryJob));

            DB::commit();
            $toastManager->success(trans('upload.success'));
        } catch (Exception $e) {
            DB::rollBack();
            $toastManager->error(trans('upload.error'));
        }

        return redirect()->action('ImageController@show', $image);
    }

    public function show(User $user, Image $image)
    {
        return view('pages.image.show', compact('image'));
    }

    public function showByMount(Mount $mount)
    {
        return view('pages.mount.related-images', compact('mount'));
    }

    public function showByCamera(Camera $camera)
    {
        return view('pages.camera.related-images', compact('camera'));
    }

    public function showByOptics(Optics $optics)
    {
        return view('pages.optics.related-images', compact('optics'));
    }
}
