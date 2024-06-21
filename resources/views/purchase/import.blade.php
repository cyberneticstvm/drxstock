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
                        <li class="breadcrumb-item active" aria-current="page">Create Purchase</li>
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
                {{ html()->form('POST', route('purchase.import.update'))->acceptsFiles()->open() }}
                <div class="card bg-white">
                    <div class="card-header py-3 border-bottom-0">
                        <h6 class="card-title mb-0">Create Purchase</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-5">
                                <label for="SquareInput" class="form-label req">Supplier</label>
                                {{ html()->select('supplier_id', $suppliers, old('supplier_id'))->class("form-control form-control-lg select2")->placeholder("Select") }}
                                @error('supplier_id')
                                <small class="text-danger">{{ $errors->first('supplier_id') }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="SquareInput" class="form-label ">Supplier Invoice</label>
                                {{ html()->text('supplier_invoice', old('supplier_invoice'))->class("form-control form-control-lg")->placeholder("Supplier Invoice") }}
                            </div>
                            <div class="col-md-2">
                                <label for="SquareInput" class="form-label ">Order Date</label>
                                {{ html()->date('order_date', old('order_date'))->class("form-control form-control-lg")->placeholder(date('Y-m-d')) }}
                            </div>
                            <div class="col-md-2">
                                <label for="SquareInput" class="form-label ">Delivery Date</label>
                                {{ html()->date('delivery_date', old('delivery_date'))->class("form-control form-control-lg")->placeholder(date('Y-m-d')) }}
                            </div>
                            <div class="col-md-5">
                                <label for="SquareInput" class="form-label ">Purchase Note</label>
                                {{ html()->text('purchase_note', old('purchase_note'))->class("form-control form-control-lg")->placeholder("Purchase Note") }}
                            </div>
                            <div class="col-md-4">
                                <label for="SquareInput" class="form-label req">Upload File</label>
                                {{ html()->file('data_file')->class("form-control form-control-lg") }}
                                @error('data_file')
                                <small class="text-danger">{{ $errors->first('data_file') }}</small>
                                @enderror
                                <div class="mt-3"><small><a href="{{ asset('/assets/docs/purchase_template.xlsx') }}">Click here to download the format</a></small></div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col text-end">
                                {{ html()->submit("Save Purchase")->class("btn btn-submit btn-dark btn-lg") }}
                            </div>
                        </div>
                    </div>
                </div>
                {{ html()->form()->close() }}
            </div>
        </div>
    </div>
</div>
@endsection