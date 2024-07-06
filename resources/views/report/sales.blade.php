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
                        <li class="breadcrumb-item active" aria-current="page">Sales Report</li>
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
                        <h6 class="card-title mb-0">Sales Report</h6>
                    </div>
                    <div class="card-body">
                        {{ html()->form('POST', route('report.sales.fetch'))->open() }}
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label for="SquareInput" class="form-label">Branch</label>
                                {{ html()->select('branch', $branches, old('branch') ?? $inputs[2])->class("form-control form-control-lg select2")->placeholder("Select") }}
                            </div>
                            <div class="col-md-2">
                                <label for="SquareInput" class="form-label req">From Date</label>
                                {{ html()->date('from_date', old('from_date') ?? $inputs[0])->class("form-control form-control-lg")->placeholder(date('Y-m-d')) }}
                                @error('from_date')
                                <small class="text-danger">{{ $errors->first('from_date') }}</small>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="SquareInput" class="form-label req">To Date</label>
                                <div class="input-group">
                                    {{ html()->date('to_date', old('to_date') ?? $inputs[1])->class("form-control form-control-lg")->placeholder(date('Y-m-d')) }}
                                    {{ html()->submit("Fetch Data")->class("btn btn-submit btn-dark btn-lg") }}
                                </div>
                                @error('to_date')
                                <small class="text-danger">{{ $errors->first('to_date') }}</small>
                                @enderror
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
                        <h6 class="card-title mb-0">Sales Report</h6>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="myDataTable table table-hover align-middle mb-0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>SL No</th>
                                    <th>Branch</th>
                                    <th>Order ID</th>
                                    <th>Customer Name</th>
                                    <th>Notes</th>
                                    <th>Date</th>
                                    <th class="text-center">Print</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->branch }}</td>
                                    <td>{{ $item->order_id }}</td>
                                    <td>{{ $item->customer_name }}</td>
                                    <td>{{ $item->notes }}</td>
                                    <td>{{ $item->created_at->format('d.M.Y') }}</td>
                                    <td class="text-center"><a href="{{ route('report.sales.detail.pdf', encrypt($item->id)) }}" target="_blank"><i class="fa fa-file-pdf-o text-danger"></i></a></td>
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