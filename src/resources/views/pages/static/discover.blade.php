@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col s12">
        {!! \SpaceDB\Http\Helpers\HtmlElement::Input('text', 'search') !!}
    </div>
</div>
@endsection