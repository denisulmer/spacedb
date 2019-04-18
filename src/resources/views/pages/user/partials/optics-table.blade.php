<div class="card">
    <div class="card-content">
        <a class="right btn-floating waves-effect" href="#add-optics-modal"><i class="material-icons">add</i></a>
        <span class="card-title">{{ trans('equipment.optics_title') }}</span>
        @if(auth()->user()->optics()->count() > 0)
            <table class="responsive-table table-striped">
                <thead>
                <tr>
                    <th>{{ trans('equipment.is_standard') }}</th>
                    <th>{{ trans('equipment.name') }}</th>
                    <th>{{ trans('equipment.aperture') }}</th>
                    <th>{{ trans('equipment.focal_length') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach(auth()->user()->optics as $optics)
                    <tr>
                        <td>
                            <div class="switch">
                                <label>
                                    <input type="checkbox" {{ $optics->pivot->is_standard ? 'checked' : '' }} name="standard-optics[]" value="{{ $optics->id }}">
                                    <span class="lever"></span>
                                </label>
                            </div>
                        </td>
                        <td>{{ $optics->name }}</td>
                        <td>{{ $optics->aperture }} mm</td>
                        <td>{{ $optics->focal_length }} mm</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <blockquote>{{ trans('equipment.no_optics') }}</blockquote>
        @endif
    </div>
</div>