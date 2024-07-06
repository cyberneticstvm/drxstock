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
                        <li class="breadcrumb-item active" aria-current="page">Export Shelf, and Box</li>
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
                        <h6 class="card-title mb-0">Export Shelf, and Box</h6>
                    </div>
                    <div class="card-body">
                        {{ html()->form('POST', route('product.export.excel.shelf.box.update'))->acceptsFiles()->open() }}
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="SquareInput" class="form-label req">Upload File</label>
                                <div class="input-group ">
                                    {{ html()->file('data_file')->class("form-control form-control-lg") }}
                                    {{ html()->submit("Upload File")->class("btn btn-submit btn-dark btn-lg") }}
                                </div>
                                @error('data_file')
                                <small class="text-danger">{{ $errors->first('data_file') }}</small>
                                @enderror
                                <div class="mt-3"><small><a href="{{ asset('/assets/docs/products_shelf_box_template.xlsx') }}">Click here to download the format</a></small></div>
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