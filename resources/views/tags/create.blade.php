@extends('layouts.app')


@section('content')

    <div class="card card-default">

        <div class="card-header">{{ isset($tag) ? 'Edit ':'Create ' }} Tag</div>

        <div class="card-body">

            @include('partials.errors')

            <form action="{{ isset($tag) ? route('tags.update', $tag->id) : route('tags.store') }}" method="POST">
                @isset($tag)
                    @method('PUT')
                @endisset


                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ isset($tag)? $tag->name: '' }}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">{{ isset($tag)? 'Update' : 'Add' }} Tag</button>
                </div>
            </form>
        </div>
    </div>

@endsection
