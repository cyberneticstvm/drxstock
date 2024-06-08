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
                        <li class="breadcrumb-item active" aria-current="page">Fetch Order</li>
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
                        <h6 class="card-title mb-0">Fetch Order</h6>
                    </div>
                    <div class="card-body">
                        {{ html()->form('POST', route('order.fetch'))->open() }}
                        <div class="row g-3">
                            <div class="col-lg-4 col-md-6">
                                <label for="SquareInput" class="form-label req">Order ID</label>
                                <div class="input-group ">
                                    {{ html()->text('order_id', $order ? $order->data->id : old('order_id'))->class("form-control form-control-lg")->placeholder("Order ID") }}
                                    {{ html()->submit("Fetch Order")->class("btn btn-submit btn-dark btn-lg") }}
                                    @error('order_id')
                                    <small class="text-danger">{{ $errors->first('order_id') }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        {{ html()->form()->close() }}
                        <div class="mt-3">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h6 class="card-title mb-3">Order Details</h6>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered mb-0">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Order ID:</th>
                                                    <td>{{ $order ? $order->data->id : 'Na' }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Order Status: </th>
                                                    <td><span class="badge bg-primary">{{ $order ? $order->data->order_status : 'Na' }}</span></td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Order Date:</th>
                                                    <td>{{ $order ? date('d.M.Y', strtotime($order->data->order_date)) : 'Na' }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Customer Name:</th>
                                                    <td>{{ $order ? $order->data->name : 'Na' }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Customer ID:</th>
                                                    <td>{{ $order ? $order->data->customer_id : 'Na' }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Branch:</th>
                                                    <td>{{ $order ? $order->data->branch_id : 'Na' }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Expected Del. Date:</th>
                                                    <td>{{ $order ? date('d.M.Y', strtotime($order->data->expected_delivery_date)) : 'Na' }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Order Note:</th>
                                                    <td>{{ $order ? $order->data->order_note : 'Na' }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Lab Note:</th>
                                                    <td>{{ $order ? $order->data->lab_note : 'Na' }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Invoice Note:</th>
                                                    <td>{{ $order ? $order->data->invoice_note : 'Na' }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection