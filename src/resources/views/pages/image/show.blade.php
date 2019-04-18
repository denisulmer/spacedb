@extends('layouts.app')

@section('content')
    <div class="row" style="margin-bottom: 0px;">
        <div class="col xl7 l12 m12 s12">
            <img src="/img/cache/gallery/{{ $image->filename }}" class="gallery-image">
        </div>
        <div class="col xl5 l6 m12 s12">
            @include('pages.image.partials.owner')
        </div>
        <div class="col xl5 l6 m12 s12">
            @include('pages.image.partials.astrometry', ['astrometryJob' => $image->astrometryJobs->sortByDesc('created_at')->first()])
        </div>
        <div class="col xl5 l6 m12 s12">
            @include('pages.image.partials.equipment')
        </div>
    </div>
    <div class="row" style="margin-bottom: 0px;">
        <div class="col s12">
            @include('pages.image.partials.description')
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            @include('pages.image.partials.comments')
        </div>
    </div>
@endsection