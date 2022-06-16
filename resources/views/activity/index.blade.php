@extends('layouts.master')
@section('title', 'Log Activity')
@section('log_active', 'active')

@section('content')

<!-- Basic Bootstrap Table -->
<div class="card">
    <div class="d-flex justify-content-between">
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
                    <th>Log Name</th>
                    <th>Log Date</th>
                    <th>Properties</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                    @foreach ($activity as $key => $item)
                    @php
                        $user = App\Models\User::where('id', $item->causer_id)->first();
                    @endphp
                        <tr>
                            <td>{{ $user->name }} have {{ $item->description }} {{ $item->log_name }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->properties }}</td>
                        </tr>
                    @endforeach
            </tbody>
        </table>

        <div class="d-inline text-center">
            {!! $activity->links('vendor.pagination.bootstrap-4') !!}
        </div>
    </div>
</div>
<!--/ Basic Bootstrap Table -->

@endsection
