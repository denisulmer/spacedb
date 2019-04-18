@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col s12">
            <h4 class="red-text text-darken-3">
                Images taken using {{ $optics->fullName() }}
            </h4>
        </div>
        @foreach($optics->images as $image)
            <div class="col s12 m6 l6 xl6">
                @include('pages.image.partials.discover-card')
            </div>
        @endforeach
    </div>
@endsection