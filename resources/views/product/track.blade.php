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
                        <li class="breadcrumb-item active" aria-current="page">Track Product</li>
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
                        <h6 class="card-title mb-0">Track Product</h6>
                    </div>
                    <div class="card-body">
                        {{ html()->form('POST', route('product.track.fetch'))->open() }}
                        <div class="row g-3">
                            <div class="col-lg-2">
                                <label for="SquareInput" class="form-label req">Type</label>
                                {{ html()->select('type_id', $types->pluck('name', 'id'),  old('type_id') ? old('type_id') : $inputs[0])->class("form-control form-control-lg select2 ptype")->placeholder("Select") }}
                                @error('type_id')
                                <small class="text-danger">{{ $errors->first('type_id') }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-2">
                                <label for="SquareInput" class="form-label req">Material</label>
                                {{ html()->select('material_id', $materials,  old('material_id') ? old('material_id') : $inputs[1])->class("form-control form-control-lg select2")->placeholder("Select") }}
                                @error('material_id')
                                <small class="text-danger">{{ $errors->first('material_id') }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-2">
                                <label for="SquareInput" class="form-label req">Coating</label>
                                {{ html()->select('coating_id', $coatings,  old('coating_id') ? old('coating_id') : $inputs[2])->class("form-control form-control-lg select2")->placeholder("Select") }}
                                @error('coating_id')
                                <small class="text-danger">{{ $errors->first('coating_id') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-3 mt-1">
                            <div class="col-lg-1">
                                <label for="SquareInput" class="form-label">Sph</label>
                                {{ html()->select('sph', $powers->where('name', 'sph')->pluck('value', 'value'), old('sph') ? old('sph') : $inputs[3])->class("form-control form-control-lg select2")->placeholder("0.00") }}
                            </div>
                            <div class="col-lg-1">
                                <label for="SquareInput" class="form-label">Cyl</label>
                                {{ html()->select('cyl', $powers->where('name', 'cyl')->pluck('value', 'value'), old('cyl') ? old('cyl') : $inputs[4])->class("form-control form-control-lg select2")->placeholder("0.00") }}
                            </div>
                            <div class="col-lg-1 divAxis">
                                <label for="SquareInput" class="form-label">Axis</label>
                                {{ html()->select('axis', $powers->where('name', 'axis')->pluck('value', 'value'), old('axis') ? old('axis') : $inputs[5])->class("form-control form-control-lg select2 selAxis")->placeholder("0") }}
                            </div>
                            <div class="col-lg-1 divAdd">
                                <label for="SquareInput" class="form-label">Add</label>
                                {{ html()->select('add', $powers->where('name', 'add')->pluck('value', 'value'), old('add') ? old('add') : $inputs[6])->class("form-control form-control-lg select2 selAdd")->placeholder("0.00") }}
                            </div>
                            <div class="col-lg-1 divEye">
                                <label for="SquareInput" class="form-label">Eye</label>
                                {{ html()->select('eye', array('RE' => 'RE', 'LE' => 'LE', 'BOTH' => 'BOTH'),  old('eye') ? old('eye') : $inputs[7])->class("form-control form-control-lg select2 selEye")->placeholder("Select") }}
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col text-end">
                                {{ html()->submit("Track Product")->class("btn btn-submit btn-dark btn-lg") }}
                            </div>
                        </div>
                        {{ html()->form()->close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-5">
        <div class="row g-3">
            <div class="col-lg-12">
                <div class="card bg-white">
                    <div class="card-header py-3 border-bottom-0">
                        <h6 class="card-title mb-0">Result</h6>
                    </div>
                    <div class="card-body">
                        <table class="myDataTable table table-hover align-middle mb-0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>SL No</th>
                                    <th>Product Name</th>
                                    <th>Code</th>
                                    <th>Category</th>
                                    <th>Type</th>
                                    <th>Coating</th>
                                    <th>Material</th>
                                    <th>[Eye | Sph | Cyl | Axis | Add]</th>
                                    <th>Shelf</th>
                                    <th>Box</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->category->name }}</td>
                                    <td>{{ $item->type->name }}</td>
                                    <td>{{ $item->coating->name }}</td>
                                    <td>{{ $item->material->name }}</td>
                                    <td>{!! $item->power() !!}</td>
                                    <td>{{ $item->shelf }}</td>
                                    <td>{{ $item->box }}</td>
                                    <td>{!! $item->status() !!}</td>
                                </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection