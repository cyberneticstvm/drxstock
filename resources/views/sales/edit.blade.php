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
                        <li class="breadcrumb-item active" aria-current="page">Update Sales</li>
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
                        <h6 class="card-title mb-0">Update Sales</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered mb-0">
                                <tbody>
                                    <tr>
                                        <th scope="row">Order ID:</th>
                                        <td>{{ $sales->order_id }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Customer Name:</th>
                                        <td>{{ $sales->customer_name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Branch:</th>
                                        <td>{{ $sales->branch }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-header py-3 border-bottom-0">
                        <h6 class="card-title mb-0">Order Details</h6>
                    </div>
                    <div class="card-body table-responsive">
                        {{ html()->form('POST', route('sales.update', $sales->id))->open() }}
                        <input type="hidden" name="order_id" value="{{ $sales->order_id }}">
                        <input type="hidden" name="customer_name" value="{{ $sales->customer_name }}">
                        <input type="hidden" name="branch" value="{{ $sales->branch }}">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Eye</th>
                                            <th width="60%">Product</th>
                                            <th class="text-center">Avlbl. Qty</th>
                                            <th class="text-center">Reqd.Qty</th>
                                            <th class="text-center">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody class="">
                                        @forelse($sales->details as $key => $item)
                                        <tr>
                                            <td>
                                                {{ html()->text('eye[]', strtoupper($item->eye))->class("form-control form-control-lg text-center")->attribute('readonly')->placeholder("0") }}
                                            </td>
                                            <td>
                                                {{ html()->select('product_id[]', $products, $item->product_id)->class("form-control form-control-lg select2 selPdct")->attribute('data-qty', $item->qty)->attribute('id', $item->id)->placeholder("Select")->required() }}
                                            </td>
                                            <td>
                                                {{ html()->number('available_qty[]', getInventory($item->product_id, $item->qty)->sum('balanceQty'), 1, '', '1')->class("form-control form-control-lg qtyAvailable text-center")->placeholder("0")->disabled() }}
                                            </td>
                                            <td>
                                                {{ html()->number('qty[]', $item->qty, 1, '', '1')->class("form-control form-control-lg qtyMax text-center")->placeholder("0")->required() }}
                                            </td>
                                            <td class="text-center">
                                                <a href="javascript:void(0)" class="dltRow"><i class="fa fa-trash text-danger"></i></a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    @empty
                                    @endforelse
                                </table>
                            </div>
                            <div class="col-md-6">
                                <label for="SquareInput" class="form-label ">Order Note</label>
                                {{ html()->text('notes', $sales->notes)->class("form-control form-control-lg")->if($old != '', function($ele){
                                    return $ele->required()->placeholder("Order Note required since the order id has already been used");
                                }) }}
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col text-end">
                                {{ html()->submit("Update Order")->class("btn btn-submit btn-dark btn-lg") }}
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