<div class="card">
    <div class="card-content">
        <span class="card-title">
            <span>{{ trans('gallery.astrometry') }}</span>
            @if($astrometryJob->status == 'solved')
                <i id="astrometry-icon" class="green-text text-darken-2 small right material-icons">done</i>
            @elseif($astrometryJob->status == 'error')
                <i id="astrometry-icon" class="yellow-text text-darken-2 small right material-icons">warning</i>
            @else
                <i id="astrometry-icon" class="right fa fa-cog fa-spin"></i>
            @endif
        </span>
        <table class="astrometry-table responsive-table">
            <tr>
                <td style="width: 50%;">{{ trans('gallery.astrometry_status') }}</td>
                <td style="width: 50%;" id="astrometry-status">{{ trans('astrometry.' . $astrometryJob->status) }}</td>
            </tr>
            <tr>
                <td>{{ trans('gallery.astrometry_ra') }}</td>
                <td id="astrometry-ra">{!! formatDegrees($astrometryJob->ra) !!}</td>
            </tr>
            <tr>
                <td>{{ trans('gallery.astrometry_dec') }}</td>
                <td id="astrometry-dec">{!! formatDegrees($astrometryJob->dec) !!}</td>
            </tr>
            <tr>
                <td>{{ trans('gallery.astrometry_scale') }}</td>
                <td id="astrometry-scale">{{ formatPixelScale($astrometryJob->pixel_scale) }}</td>
            </tr>
            <tr>
                <td>{{ trans('gallery.astrometry_link') }}</td>
                <td id="astrometry-submission-id">
                    <a href="{{ $astrometryJob->getUrl() }}">{{ $astrometryJob->submission_id or '' }}</a>
                </td>
            </tr>
            @if($image->objects()->count() > 0)
                <tr>
                    <td class="valign-wrapper">{{ trans('gallery.astrometry_objects') }}</td>
                    <td>
                        @foreach($image->objects as $object)
                            @if(!$loop->last)
                                <a href="/object/{{ str_slug($object->name) }}">{{ $object->name }}</a>,
                            @else
                                <a href="/object/{{ str_slug($object->name) }}">{{ $object->name }}</a>
                            @endif
                        @endforeach
                    </td>
                </tr>
            @endif
        </table>


    </div>
</div>