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
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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

<div class="body px-xl-4 px-md-2">
    <div class="container-fluid">
        <div class="row g-2 row-deck mb-2">
            <div class="col-xl-3 col-6">
                <div class="card">
                    <div class="card-body text-center">
                        <a href="{{ route('dashboard') }}"><i class="fa fa-user fa-2x text-success"></i></a>
                        <h5 class="mt-0 mb-3"><a href="{{ route('dashboard') }}" class="text-muted">USER</a></h5>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-6">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="fa fa-bars fa-2x text-success"></i>
                        <div class="mb-0">
                            <h5 class="mt-0 mb-3"><a href="{{ route('dashboard') }}" class="text-muted">CATEGORY</a></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-6">
                <div class="card">
                    <div class="card-body text-center">
                        <a href="{{ route('dashboard') }}"><i class="fa fa-bookmark fa-2x text-success"></i></a>
                        <h5 class="mt-0 mb-3"><a href="{{ route('dashboard') }}" class="text-muted">TYPE</a></h5>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-6">
                <div class="card">
                    <div class="card-body text-center">
                        <a href="{{ route('dashboard') }}"><i class="fa fa-crop fa-2x text-success"></i></a>
                        <h5 class="mt-0 mb-3"><a href="{{ route('dashboard') }}" class="text-muted">MATERIAL</a></h5>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-6">
                <div class="card">
                    <div class="card-body text-center">
                        <a href="{{ route('dashboard') }}"><i class="fa fa-paint-brush fa-2x text-success"></i></a>
                        <h5 class="mt-0 mb-3"><a href="{{ route('dashboard') }}" class="text-muted">COATING</a></h5>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-6">
                <div class="card">
                    <div class="card-body text-center">
                        <a href="{{ route('dashboard') }}"><i class="fa fa-cubes fa-2x text-success"></i></a>
                        <h5 class="mt-0 mb-3"><a href="{{ route('dashboard') }}" class="text-muted">PRODUCT</a></h5>
                    </div>
                </div>
            </div>
        </div> <!-- Row end  -->
    </div>
</div>
@endsection