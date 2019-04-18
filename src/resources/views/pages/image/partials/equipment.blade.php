<div class="card">
    <div class="card-content">
        <span class="card-title">
            <span>{{ trans('gallery.equipment') }}</span>
        </span>
        <table class="equipment-table responsive-table">
            <tr>
                <td>
                    {{ trans('gallery.mounts') }}
                </td>
                <td>
                    @foreach($image->mounts as $mount)
                        @if(!$loop->last)
                            <a href="/mount/{{ $mount->id }}">{{ $mount->fullName() }}</a>,
                        @else
                            <a href="/mount/{{ $mount->id }}">{{ $mount->fullName() }}</a>
                        @endif
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>
                    {{ trans('gallery.optics') }}
                </td>
                <td>
                    @foreach($image->optics as $optics)
                        @if(!$loop->last)
                            <a href="/optics/{{ $optics->id }}">{{ $optics->fullName() }}</a>,
                        @else
                            <a href="/optics/{{ $optics->id }}">{{ $optics->fullName() }}</a>
                        @endif
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>
                    {{ trans('gallery.cameras') }}
                </td>
                <td>
                    @foreach($image->cameras as $camera)
                        @if(!$loop->last)
                            <a href="/camera/{{ $camera->id }}">{{ $camera->fullName() }}</a>,
                        @else
                            <a href="/camera/{{ $camera->id }}">{{ $camera->fullName() }}</a>
                        @endif
                    @endforeach
                </td>
            </tr>
        </table>
    </div>
</div>