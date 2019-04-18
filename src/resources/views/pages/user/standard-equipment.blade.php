@extends('layouts.app')

@section('content')
    <form action="{{ route('update_equipment') }}" method="POST">
        {{ csrf_field() }}
        <div class="row">
            <div class="col xl12 l12 m12 s12">
                @include('pages.user.partials.optics-table')
            </div>
            <div class="col xl12 l12 m12 s12">
                @include('pages.user.partials.mounts-table')
            </div>
            <div class="col xl12 l12 m12 s12">
                @include('pages.user.partials.cameras-table')
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <button class="btn waves-effect" type="submit" name="action">
                    {{ trans('equipment.save_changes') }}
                    <i class="material-icons right">save</i>
                </button>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
<script type="text/javascript">
    $(".switch").find("input[type=checkbox]").on("change", function () {
        var status = $(this).prop('checked');
        console.log($(this).attr('data-update-url'));
        console.log(status);
    });
</script>
@endpush