@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Manage Access for Role: {{ $role->name }}
                </div>
                <div class="card-body">
                    <form action="{{ route('roles.saveAccess', $role->id) }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            @foreach ($permissions->chunk(4) as $permissionChunk)
                                <div class="col-md-3">
                                    @foreach ($permissionChunk as $permission)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="permission-{{ $permission->id }}"
                                                {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="permission-{{ $permission->id }}">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                            <a href="{{ route('roles.index') }}" class="btn btn-secondary btn-sm">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
