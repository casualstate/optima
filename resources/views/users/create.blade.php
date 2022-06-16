@extends('layouts.master')
@section('title', 'User')
@section('user_active', 'active')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <h5 class="card-header">Create New User</h5>
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="post">
                    @csrf
                    <div class="mb-3 row">
                        <label for="html5-text-input" class="col-md-3 col-form-label">Nama</label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="name">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="html5-email-input" class="col-md-3 col-form-label">Email</label>
                        <div class="col-md-9">
                            <input class="form-control" type="email" name="email">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="html5-password-input" class="col-md-3 col-form-label">Password</label>
                        <div class="col-md-9">
                            <input class="form-control" type="password" name="password">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="html5-password-input" class="col-md-3 col-form-label">Confirm Password</label>
                        <div class="col-md-9">
                            <input class="form-control" type="password" name="confirm-password">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="html5-search-input" class="col-md-3 col-form-label">Role User</label>
                        <div class="col-md-9">
                            <select name="role" class="form-select">
                                <option selected disabled>Pilih Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="html5-text-input" class="col-md-3 col-form-label"></label>
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="{{ route('users.index') }}" class="btn btn-danger">Kembali</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection
