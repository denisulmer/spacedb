@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col xl10 offset-xl1 l12 m12 s12">
            <div class="card">
                <form action="{{ route('store_image') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="card-content">
                        <span class="card-title">{{ trans('upload.title') }}</span>

                        @include('forms.errors')

                        <div class="row">
                            <div class="input-field col s12">
                                <input spellcheck="false" name="name" class="{{ $errors->has('name') ? ' invalid' : '' }}" placeholder="" data-length="60" autocomplete="off" class="" id="upload-input-name" type="text" value="{{ old('name') }}">
                                <label for="upload-input-name" class="active">{{ trans('upload.name') }}</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="file-field input-field col s12">
                                <div class="btn">
                                    <span>{{ trans('upload.image_file') }}</span>
                                    <input type="file" name="image-file" accept="image/">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="file-field input-field col s12">
                                <textarea spellcheck="false" class="{{ $errors->has('description') ? ' invalid' : '' }} materialize-textarea" name="description" placeholder="" data-length="300">{{ old('description') }}</textarea>
                                <label for="description" class="active">{{ trans('upload.description') }}</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s12">
                                <h5>{{ trans('upload.used_equipment') }}</h5>
                            </div>
                            <div class="input-field col xl6 s12">
                                <select name="optics[]" multiple class="{{ $errors->has('optics') ? ' invalid' : '' }}">
                                    <option value="" disabled>{{ trans('upload.optics_select_text') }}</option>
                                    @foreach(auth()->user()->optics as $optics)
                                        <option {{ $optics->pivot->is_standard ? 'selected' : '' }} value="{{ $optics->id }}">{{ $optics->name }}</option>
                                    @endforeach
                                </select>
                                <label>{{ trans('upload.optics_select') }}</label>
                            </div>
                            <div class="input-field col xl6 s12">
                                <select name="cameras[]" multiple>
                                    <option value="" disabled>{{ trans('upload.cameras_select_text') }}</option>
                                    @foreach(auth()->user()->cameras as $camera)
                                        <option {{ $camera->pivot->is_standard ? 'selected' : '' }} value="{{ $camera->id }}">{{ $camera->name }}</option>
                                    @endforeach
                                </select>
                                <label>{{ trans('upload.cameras_select') }}</label>
                            </div>
                            <div class="input-field col xl6 s12">
                                <select name="mounts[]" multiple>
                                    <option value="" disabled>{{ trans('upload.mounts_select_text') }}</option>
                                    @foreach(auth()->user()->mounts as $mount)
                                        <option {{ $mount->pivot->is_standard ? 'selected' : '' }} value="{{ $mount->id }}">{{ $mount->fullName() }}</option>
                                    @endforeach
                                </select>
                                <label>{{ trans('upload.mounts_select') }}</label>
                            </div>
                            <div class="input-field col xl6 s12">
                                <select name="mounts[]" multiple>
                                    <option value="" disabled>{{ trans('upload.mounts_select_text') }}</option>
                                    @foreach(auth()->user()->mounts as $mount)
                                        <option {{ $mount->pivot->is_standard ? 'selected' : '' }} value="{{ $mount->id }}">{{ $mount->fullName() }}</option>
                                    @endforeach
                                </select>
                                <label>{{ trans('upload.mounts_select') }}</label>
                            </div>
                        </div>

                        <button type="submit" class=" waves-effect waves-light btn">{{ trans('upload.button') }}</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col xl6 offset-xl3 l12 m12 s12">
            </div>
        </div>
    </div>
@endsection