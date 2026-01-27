@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <a class="btn btn-secondary btn-sm mb-3" href="{{ route('roles.index') }}"><i class="fa fa-angle-left" aria-hidden="true"></i> Back</a>
    <div class="card">
        <div class="card-header">
            <h3 class="h4 mb-0">&nbsp;Show Role</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        {{ $role->name }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Permissions:</strong>
                        @if(!empty($role->getPermissionNames()))
                            @foreach($role->getPermissionNames() as $v)
                                <label class="badge badge-success">{{ $v }}</label>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
