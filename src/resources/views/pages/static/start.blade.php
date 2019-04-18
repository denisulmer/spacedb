@extends('layouts.app')

@section('content')
    @if (auth()->check() and auth()->user()->hasStandardEquipment() == false)
        <div class="row">
            <div class="col s12 m12 l12 xl12">
                @include('pages.start.partials.equipment-notice')
            </div>
        </div>
    @endif
    <section>
        @foreach($images as $image)
            <div class="image-box z-depth-4 hoverable" style="width:{{$image->width*200/$image->height}}px;flex-grow:{{$image->width*200/$image->height}}">
                <a href="{{ route('image', $image) }}">
                    <i style="padding-bottom:{{$image->height/$image->width*100}}%"></i>
                    <img src="{{$image->getUrl('large')}}" alt="">
                </a>
            </div>
        @endforeach
    </section>
@endsection