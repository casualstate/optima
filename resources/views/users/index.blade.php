@extends('layouts.master')
@section('title', 'User')
@section('user_active', 'active')

@section('content')

<!-- Basic Bootstrap Table -->
<div class="card">
    <div class="d-flex justify-content-between">
        <h5 class="card-header">
            <a href="{{ route('users.create') }}" class="btn btn-primary">Create New User</a>
        </h5>
    </div>
    <div class="table-responsive text-nowrap">
        @if(session()->get('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ session()->get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Date Created</th>
                    <th>Roles</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                    @foreach ($users as $key => $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->created_at->toFormattedDateString() }}</td>
                            <td>{{ $item->roles[0]->display_name }}</td>
                            <td class="has-text-right">
                                <a class="button is-light" href="{{route('users.edit', $item->id)}}">Edit</a>
                                @if ($item->roles[0]->name != 'admin' && $item->roles[0]->name != 'hero')
                                    <form action="{{ route('users.destroy', $item->id)}}" method="post" id="deleteUser">
                                    @csrf
                                    @method('DELETE')
                                    <a href="#" onclick="document.getElementById('deleteUser').submit()">Delete</a>
                                  </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
            </tbody>
        </table>

        <div class="d-inline text-center">
            {!! $users->links('vendor.pagination.bootstrap-4') !!}
        </div>
    </div>
</div>
<!--/ Basic Bootstrap Table -->

@endsection
