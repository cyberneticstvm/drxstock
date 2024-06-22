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
                        <li class="breadcrumb-item active" aria-current="page">Update Product</li>
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
                        <h6 class="card-title mb-0">Update Product</h6>
                    </div>
                    <div class="card-body">
                        {{ html()->form('POST', route('product.update', $product->id))->open() }}
                        <div class="row g-3">
                            <div class="col-lg-2">
                                <label for="SquareInput" class="form-label req">Type</label>
                                {{ html()->select('type_id', $types->pluck('name', 'id'),  $product->type_id)->class("form-control form-control-lg select2")->placeholder("Select") }}
                                @error('type_id')
                                <small class="text-danger">{{ $errors->first('type_id') }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-2">
                                <label for="SquareInput" class="form-label req">Material</label>
                                {{ html()->select('material_id', $materials,  $product->material_id)->class("form-control form-control-lg select2")->placeholder("Select") }}
                                @error('material_id')
                                <small class="text-danger">{{ $errors->first('material_id') }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-2">
                                <label for="SquareInput" class="form-label req">Coating</label>
                                {{ html()->select('coating_id', $coatings,  $product->coating_id)->class("form-control form-control-lg select2")->placeholder("Select") }}
                                @error('coating_id')
                                <small class="text-danger">{{ $errors->first('coating_id') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-3 mt-1">
                            <div class="col-lg-1">
                                <label for="SquareInput" class="form-label">Sph</label>
                                {{ html()->select('sph', $powers->where('name', 'sph')->pluck('value', 'value'), $product->sph)->class("form-control form-control-lg select2")->placeholder("Select") }}
                            </div>
                            <div class="col-lg-1">
                                <label for="SquareInput" class="form-label">Cyl</label>
                                {{ html()->select('cyl', $powers->where('name', 'cyl')->pluck('value', 'value'), $product->cyl)->class("form-control form-control-lg select2")->placeholder("Select") }}
                            </div>
                            <div class="col-lg-1">
                                <label for="SquareInput" class="form-label">Axis</label>
                                {{ html()->select('axis', $powers->where('name', 'axis')->pluck('value', 'value'), $product->axis)->class("form-control form-control-lg select2 selAxis")->placeholder("Select") }}
                            </div>
                            <div class="col-lg-1">
                                <label for="SquareInput" class="form-label">Add</label>
                                {{ html()->select('add', $powers->where('name', 'add')->pluck('value', 'value'), $product->add)->class("form-control form-control-lg select2")->placeholder("Select") }}
                            </div>
                            <div class="col-lg-1">
                                <label for="SquareInput" class="form-label">Eye</label>
                                {{ html()->select('eye', array('RE' => 'RE', 'LE' => 'LE', 'BOTH' => 'BOTH'),  $product->eye)->class("form-control form-control-lg select2")->placeholder("Select") }}
                            </div>
                            <div class="col-lg-1">
                                <label for="SquareInput" class="form-label">Shelf</label>
                                {{ html()->text('shelf', $product->shelf)->class("form-control form-control-lg")->placeholder("Shelf") }}
                            </div>
                            <div class="col-lg-1">
                                <label for="SquareInput" class="form-label">Box</label>
                                {{ html()->text('box', $product->box)->class("form-control form-control-lg")->placeholder("Box") }}
                            </div>
                            <div class="col-lg-1">
                                <label for="SquareInput" class="form-label">Re.Qty</label>
                                {{ html()->number('reorder_qty', $product->reorder_qty, '', '', 1)->class("form-control form-control-lg")->placeholder("0") }}
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col text-end">
                                {{ html()->submit("Update Product")->class("btn btn-submit btn-dark btn-lg") }}
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