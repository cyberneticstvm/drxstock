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
                        <li class="breadcrumb-item active" aria-current="page">Update User</li>
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
                        <h6 class="card-title mb-0">Update User</h6>
                    </div>
                    <div class="card-body">
                        {{ html()->form('POST', route('user.update', $user->id))->open() }}
                        <div class="row g-3">
                            <div class="col-lg-3 col-md-6">
                                <label for="SquareInput" class="form-label req">Full Name</label>
                                {{ html()->text('name', $user->name)->class("form-control form-control-lg")->placeholder("Full Name") }}
                                @error('name')
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <label for="SquareInput" class="form-label req">Email</label>
                                {{ html()->text("email", $user->email)->class("form-control form-control-lg")->placeholder("Email") }}
                                @error('email')
                                <small class="text-danger">{{ $errors->first('email') }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <label for="SquareInput" class="form-label req">Username</label>
                                {{ html()->text("username", $user->username)->class("form-control form-control-lg")->placeholder("username") }}
                                @error('username')
                                <small class="text-danger">{{ $errors->first('username') }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <label for="SquareInput" class="form-label req">Password</label>
                                {{ html()->password("password", "")->class("form-control form-control-lg")->placeholder("******") }}
                                @error('password')
                                <small class="text-danger">{{ $errors->first('password') }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <label class="form-label req" for="role">Role</label>
                                {{ html()->select($name = 'roles', $value = $roles, $userRole)->class('form-control select2')->placeholder('Select Role') }}
                                @error('roles')
                                <small class="text-danger">{{ $errors->first('roles') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col text-end">
                                {{ html()->submit("Update User")->class("btn btn-submit btn-dark btn-lg") }}
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