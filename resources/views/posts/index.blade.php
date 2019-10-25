@extends('layouts.app')



@section('content')

    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('posts.create') }}" class="btn btn-success">Add Post</a>
    </div>

    <div class="card card-default">
        <div class="card-header">Posts</div>

        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th colspan="2"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                <tr>
                    <td><img src="{{ asset('storage/'.$post->image) }}" width="90" alt=""></td>
                    <td>{{ $post->title }}</td>
                    <td><a href="" class="btn btn-info btn-sm text-white">Edit</a></td>
                    <td>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm text-white">Trash</button>
                        </form>

                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>


@endsection
