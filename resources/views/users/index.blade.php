@extends('layouts.app')



@section('content')



    <div class="card card-default">
        <div class="card-header">Users</div>

        <div class="card-body">
            @if($users->count() > 0)
                <table class="table">
                    <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th colspan="2"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td><img src="{{ Gravatar::src($user->email) }}" alt="{{ $user->name }}" width="50" style="border-radius: 50%"></td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>

                            <td>
                                @if(!$user->isAdmin())
                                <form action="{{ route('users.make-admin', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-success btn-sm text-white">
                                        Make Admin
                                    </button>
                                </form>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            @else
                <h3 class="text-center">No Users Yet</h3>
            @endif



        </div>
    </div>


@endsection
