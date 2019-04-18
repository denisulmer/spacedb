<div class="card">
    <div class="card-content">
        <a class="right btn-floating waves-effect" href="#!"><i class="material-icons">add</i></a>
        <span class="card-title">{{ trans('equipment.cameras_title') }}</span>
        @if(auth()->user()->cameras()->count() > 0)
            <table class="responsive-table table-striped">
                <thead>
                <tr>
                    <th>{{ trans('equipment.is_standard') }}</th>
                    <th>{{ trans('equipment.name') }}</th>
                    <th>{{ trans('equipment.resolution') }}</th>
                    <th>{{ trans('equipment.chip_size') }}</th>
                    <th>{{ trans('equipment.pixel_size') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach(auth()->user()->cameras as $camera)
                    <tr>
                        <td>
                            <div class="switch">
                                <label>
                                    <input type="checkbox" name="standard-cameras[]" {{ $camera->pivot->is_standard ? 'checked' : '' }} class="equipment-standard-toggle" value="{{ $camera->id }}">
                                    <span class="lever"></span>
                                </label>
                            </div>
                        </td>
                        <td>{{ $camera->name }}</td>
                        <td>{{ $camera->resolutionX }} pixel x {{ $camera->resolutionY }} pixel</td>
                        <td>{{ $camera->ccdWidth }} mm x {{ $camera->ccdHeight }} mm</td>
                        <td>{{ $camera->pixelWidth }} &micro;m x {{ $camera->pixelHeight }} &micro;m</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <blockquote>{{ trans('equipment.no_cameras') }}</blockquote>
        @endif
    </div>
</div>