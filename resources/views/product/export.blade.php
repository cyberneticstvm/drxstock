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
                        <li class="breadcrumb-item active" aria-current="page">Export Product</li>
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
                        <h6 class="card-title mb-0">Export Product</h6>
                    </div>
                    <div class="card-body">
                        {{ html()->form('POST', route('product.export.fetch'))->open() }}
                        <div class="row g-3">
                            <div class="col-lg-2">
                                <label for="SquareInput" class="form-label">Type</label>
                                {{ html()->select('type_id', $types->pluck('name', 'id'),  old('type_id') ?? $inputs[8])->class("form-control form-control-lg select2 ptype pType1")->placeholder("Select") }}
                                @error('type_id')
                                <small class="text-danger">{{ $errors->first('type_id') }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-2">
                                <label for="SquareInput" class="form-label">Material</label>
                                {{ html()->select('material_id', $materials,  old('material_id') ?? $inputs[9])->class("form-control form-control-lg select2")->placeholder("Select") }}
                                @error('material_id')
                                <small class="text-danger">{{ $errors->first('material_id') }}</small>
                                @enderror
                            </div>
                            <div class="col-lg-2">
                                <label for="SquareInput" class="form-label">Coating</label>
                                {{ html()->select('coating_id', $coatings,  old('coating_id') ?? $inputs[10])->class("form-control form-control-lg select2")->placeholder("Select") }}
                                @error('coating_id')
                                <small class="text-danger">{{ $errors->first('coating_id') }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-3 mt-1">
                            <div class="col-lg-1">
                                <label for="SquareInput" class="form-label">Sph From</label>
                                {{ html()->select('sph_from', $powers->where('name', 'sph')->pluck('value', 'value'), old('sph_from') ?? $inputs[0])->class("form-control form-control-lg select2")->placeholder("Select") }}
                            </div>
                            <div class="col-lg-1">
                                <label for="SquareInput" class="form-label">Sph To</label>
                                {{ html()->select('sph_to', $powers->where('name', 'sph')->pluck('value', 'value'), old('sph_to') ?? $inputs[1])->class("form-control form-control-lg select2")->placeholder("Select") }}
                            </div>
                            <div class="col-lg-1">
                                <label for="SquareInput" class="form-label">Cyl From</label>
                                {{ html()->select('cyl_from', $powers->where('name', 'cyl')->pluck('value', 'value'), old('cyl_from') ?? $inputs[2])->class("form-control form-control-lg select2")->placeholder("Select") }}
                            </div>
                            <div class="col-lg-1">
                                <label for="SquareInput" class="form-label">Cyl To</label>
                                {{ html()->select('cyl_to', $powers->where('name', 'cyl')->pluck('value', 'value'), old('cyl_to') ?? $inputs[3])->class("form-control form-control-lg select2")->placeholder("Select") }}
                            </div>
                            <div class="col-lg-1 divAxis">
                                <label for="SquareInput" class="form-label">Axis From</label>
                                {{ html()->select('axis_from', $powers->where('name', 'axis')->pluck('value', 'value'), old('axis_from') ?? $inputs[4])->class("form-control form-control-lg select2")->placeholder("Select") }}
                            </div>
                            <div class="col-lg-1 divAxis">
                                <label for="SquareInput" class="form-label">Axis To</label>
                                {{ html()->select('axis_to', $powers->where('name', 'axis')->pluck('value', 'value'), old('axis_to') ?? $inputs[5])->class("form-control form-control-lg select2")->placeholder("Select") }}
                            </div>
                            <div class="col-lg-1 divAdd">
                                <label for="SquareInput" class="form-label">Add From</label>
                                {{ html()->select('add_from', $powers->where('name', 'add')->pluck('value', 'value'), old('add_from') ?? $inputs[6])->class("form-control form-control-lg select2")->placeholder("Select") }}
                            </div>
                            <div class="col-lg-1 divAdd">
                                <label for="SquareInput" class="form-label">Add To</label>
                                {{ html()->select('add_to', $powers->where('name', 'add')->pluck('value', 'value'), old('add_to') ?? $inputs[7])->class("form-control form-control-lg select2")->placeholder("Select") }}
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col text-end">
                                {{ html()->submit("Fetch Product")->class("btn btn-submit btn-dark btn-lg") }}
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
                        <div class="row">
                            <div class="col-6">
                                <h6 class="card-title mb-0">Result</h6>
                            </div>
                            <div class="col-6 text-end">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Export</button>
                                    <ul class="dropdown-menu border-0 shadow">
                                        <li><a class="dropdown-item text-dark" href="{{ route('product.limit.export.excel', ['params' => serialize($inputs)]) }}"><i class="fa fa-file-excel-o text-primary me-3"></i>Excel</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item text-dark" href="{{ route('product.limit.export.pdf') }}"><i class="fa fa-file-pdf-o text-danger me-3"></i>PDF</a></li>
                                    </ul>
                                </div><!-- /btn-group -->
                            </div>
                        </div>
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
                                    <th>[Eye &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp; Sph &nbsp;&nbsp;&nbsp;| Cyl | Axis | Add]</th>
                                    <th class="text-center">Avl. Qty</th>
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
                                    <td>{{ $item->category?->name }}</td>
                                    <td>{{ $item->type?->name }}</td>
                                    <td>{{ $item->coating?->name }}</td>
                                    <td>{{ $item->material?->name }}</td>
                                    <td>{!! $item->power() !!}</td>
                                    <td class="text-center">{{ getInventory($item->id, 0)->sum('balanceQty') }}</td>
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