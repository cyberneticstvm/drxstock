@extends("base")
@section("content")
<!-- Body: Header -->
<div class="body-header border-0 rounded-0 px-xl-4 px-md-2">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center py-2">
                    <ol class="breadcrumb rounded-0 mb-0 ps-0 bg-transparent flex-grow-1">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Role</li>
                    </ol>
                    <div class="d-flex flex-wrap align-items-center">
                        <button class="btn btn-dark ms-1" type="button"><i class="fa fa-refresh"></i></button>
                        <button class="btn btn-dark d-none d-sm-inline-block ms-1" type="button">Export PDF</button>
                    </div>
                </div>
            </div>
        </div> <!-- .row end -->

    </div>
</div>
<!-- Body: Body -->
<div class="body d-flex py-lg-4 py-3">
    <div class="container-fluid">
        <div class="row g-3">
            <div class="col-lg-12">
                <div class="card bg-white">
                    <div class="card-header py-3 border-bottom-0">
                        <h6 class="card-title mb-0">Create Role</h6>
                    </div>
                    <div class="card-body">
                        {{ html()->form('POST', route('role.save'))->open() }}
                        <div class="row g-3">
                            <div class="col-lg-6 col-md-6">
                                <label for="SquareInput" class="form-label req">Role Name</label>
                                {{ html()->text('name', old('name'))->class("form-control form-control-lg")->placeholder("Role Name") }}
                                @error('name')
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                                @enderror
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-12 col-md-6"><label class="form-label req">Permission</label></div>
                                @foreach($permissions as $permission)
                                <div class="col-lg-2 col-4">
                                    <label class="form-check-label" for="">{{ $permission->name }}</label><br />
                                    {{ html()->checkbox($name = 'permission[]', $checked=false, $value = $permission->id)->class('form-check-input') }}
                                </div>
                                @endforeach
                                @error('permission')
                                <small class="text-danger">{{ $errors->first('permission') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col text-end">
                                {{ html()->submit("Save Role")->class("btn btn-submit btn-dark btn-lg") }}
                            </div>
                        </div>
                        {{ html()->form()->close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection