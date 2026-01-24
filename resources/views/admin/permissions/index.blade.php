@extends('layouts.app')

@section('content')
<div class="container-fluid py-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Permissions
                    <a href="{{ route('permissions.create') }}" class="btn btn-primary btn-sm float-right">Add New Permission</a>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="50">No</th>
                                <th>Name</th>
                                <!-- <th width="280px">Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $permission->name }}</td>
                                <!-- <td>
                                    <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST">
                                        <a class="btn btn-primary btn-sm" href="{{ route('permissions.edit', $permission->id) }}">Edit</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this permission?')">Delete</button>
                                    </form>
                                </td> -->
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
