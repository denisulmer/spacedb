<div class="card">
    <div class="card-content">
        <a class="right btn-floating waves-effect" href="#!"><i class="material-icons">add</i></a>
        <span class="card-title">{{ trans('equipment.mounts_title') }}</span>
        @if(auth()->user()->mounts()->count() > 0)
            <table class="responsive-table table-striped">
                <thead>
                <tr>
                    <th>{{ trans('equipment.is_standard') }}</th>
                    <th>{{ trans('equipment.manufacturer') }}</th>
                    <th>{{ trans('equipment.name') }}</th>
                    <th>{{ trans('equipment.mount_capacity') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach(auth()->user()->mounts as $mount)
                    <tr>
                        <td>
                            <div class="switch">
                                <label>
                                    <input type="checkbox" {{ $mount->pivot->is_standard ? 'checked' : '' }} name="standard-mounts[]" value="{{ $mount->id }}">
                                    <span class="lever"></span>
                                </label>
                            </div>
                        </td>
                        <td>{{ $mount->manufacturer->name }}</td>
                        <td>{{ $mount->name }}</td>
                        <td>{{ $mount->weight_capacity }} kg</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <blockquote>{{ trans('equipment.no_mounts') }}</blockquote>
        @endif
    </div>
</div>