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
                        <li class="breadcrumb-item active" aria-current="page">Update Damage</li>
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
                        <h6 class="card-title mb-0">Update Damage</h6>
                    </div>
                    <div class="card-body">
                        {{ html()->form('POST', route('damage.update', $damage->id))->open() }}
                        <div class="row g-3">
                            <div class="col-lg-4 col-md-6">
                                <label for="SquareInput" class="form-label req">Product</label>
                                {{ html()->select('product_id', $products,  $damage->product_id)->class("form-control form-control-lg select2")->placeholder("Select") }}
                                @error('product_id')
                                <small class="text-danger">{{ $errors->first('product_id') }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-2">
                                <label for="SquareInput" class="form-label req">Qty</label>
                                {{ html()->number('qty', $damage->qty, 0, '', 1)->class("form-control form-control-lg")->placeholder("0") }}
                                @error('qty')
                                <small class="text-danger">{{ $errors->first('qty') }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <label for="SquareInput" class="form-label req">Notes / Reason</label>
                                {{ html()->text('notes', $damage->notes)->class("form-control form-control-lg")->placeholder("Notes / Reason") }}
                                @error('notes')
                                <small class="text-danger">{{ $errors->first('notes') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col text-end">
                                {{ html()->submit("Update Damage")->class("btn btn-submit btn-dark btn-lg") }}
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