@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col s12">
            <h4 class="red-text text-darken-3">
                Images that contain {{ $object->name }}
            </h4>
        </div>
        @foreach($object->images as $image)
            <div class="col s12 m6 l6 xl6">
                @include('pages.image.partials.discover-card')
            </div>
        @endforeach
    </div>
@endsection