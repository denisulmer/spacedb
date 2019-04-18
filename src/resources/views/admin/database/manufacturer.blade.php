@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-content">
            <span class="card-title">Enter new manufacturer</span>

            @include('forms.errors')

            <form action="{{ route('manufacturer.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="input-field">
                    <input type="text" name="name" placeholder="">
                    <label for="name" class="active">Name</label>
                </div>
                <button type="submit" class="btn">Create</button>
            </form>
        </div>
    </div>

    <div class="card-panel">
        <table class="thin-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($manufacturers as $manufacturer)
                <tr>
                    <td><p>{{ $manufacturer->id }}</p></td>
                    <td><input type="text" name="name" value="{{ $manufacturer->name }}"></td>
                    <td><a class="btn waves-effect right" href="#">save</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection