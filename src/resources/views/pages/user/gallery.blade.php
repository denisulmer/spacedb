@extends('layouts.app')

@section('content')
        <div class="row">
            <div class="col s12 l8">
                <div class="card-panel grey lighten-5 z-depth-1" style="padding: 0;">
                    <div class="row valign-wrapper" style="margin-bottom: 0px;">
                        <div class="col s3 m2">
                            <img src="/images/astrometry-icon.jpg" alt="" class="responsive-img"> <!-- notice the "circle" class -->
                        </div>
                        <div class="col s9 m10">
                            <h5 style="margin-top: 0;">Astrometry Status</h5>
                                <span class="black-text">
                                This is a square image. Add the "circle" class to it to make it appear circular.
                                </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($images as $image)
                <div class="col s12 l6">
                    <div class="card">
                        <div class="card-image waves-effect waves-block waves-light">
                            <img class="activator" src="{{ $image->getUrl('medium') }}">
                        </div>
                        <div class="card-content">
                            <span class="card-title activator grey-text text-darken-4">
                                {{ $image->name }}
                                <i class="material-icons right">more_vert</i>
                            </span>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
                            <p>Here is some more information about this product that is only revealed once clicked on.</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
@endsection