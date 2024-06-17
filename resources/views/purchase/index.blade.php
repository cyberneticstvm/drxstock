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
                        <li class="breadcrumb-item active" aria-current="page">Purchase Register</li>
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
                        <h6 class="card-title mb-0">Purchase Register</h6>
                    </div>
                    <div class="card-body">
                        <table class="myDataTable table table-hover align-middle mb-0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>SL No</th>
                                    <th>Purchase Id</th>
                                    <th>Supplier</th>
                                    <th>Supplier Invoice</th>
                                    <th>Ord. Date</th>
                                    <th>Del. Date</th>
                                    <th>Notes</th>
                                    <th>Status</th>
                                    <th class="text-center">Edit</th>
                                    <th class="text-center">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($purchases as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->pid() }}</td>
                                    <td>{{ $item->supplier->name }}</td>
                                    <td>{{ $item->supplier_invoice }}</td>
                                    <td>{{ $item->order_date?->format('d.M.Y') }}</td>
                                    <td>{{ $item->delivery_date?->format('d.M.Y') }}</td>
                                    <td>{{ $item->purchase_note }}</td>
                                    <td>{!! $item->status() !!}</td>
                                    <td class="text-center"><a href="{{ route('purchase.edit', encrypt($item->id)) }}"><i class="fa fa-magic text-warning"></i></a></td>
                                    <td class="text-center"><a class="dlt" href="{{ route('purchase.delete', encrypt($item->id)) }}"><i class="fa fa-trash text-danger"></i></a></td>
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