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
                        <li class="breadcrumb-item active" aria-current="page">Create Sales</li>
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
                        <h6 class="card-title mb-0">Create Sales</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="table-responsive">
                                    <table class="table table-sm table-bordered mb-0">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Order ID:</th>
                                                <td>{{ $order ? $order->data->id : 'Na' }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Customer Name:</th>
                                                <td>{{ $order ? $order->data->name : 'Na' }}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Branch:</th>
                                                <td>{{ $order ? $order->branch->name : 'Na' }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <table class="table table-sm table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>SL No</th>
                                            <th>Product</th>
                                            <th>Qty</th>
                                            <th>SPH</th>
                                            <th>CYL</th>
                                            <th>AXIS</th>
                                            <th>ADD</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($order->odetail as $key => $item)
                                        @if(in_array($item->eye, ['re', 'le']))
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>{{ $item->sph }}</td>
                                            <td>{{ $item->cyl }}</td>
                                            <td>{{ $item->axis }}</td>
                                            <td>{{ $item->add }}</td>
                                        </tr>
                                        @endif
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-header py-3 border-bottom-0">
                        <h6 class="card-title mb-0">Order Details</h6>
                    </div>
                    <div class="card-body table-responsive">
                        {{ html()->form('POST', route('sales.save'))->open() }}
                        <input type="hidden" name="order_id" value="{{ $order->data->id }}">
                        <input type="hidden" name="customer_name" value="{{ $order->data->name }}">
                        <input type="hidden" name="branch" value="{{ $order->branch->name }}">
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
                                        @forelse($order->odetail as $key => $item)
                                        @if(in_array($item->eye, ['re', 'le']))
                                        <tr>
                                            <td>
                                                {{ html()->text('eye[]', strtoupper($item->eye))->class("form-control form-control-lg text-center")->attribute('readonly')->placeholder("0") }}
                                            </td>
                                            <td>
                                                {{ html()->select('product_id[]', $products, '')->class("form-control form-control-lg select2 selPdct")->attribute('data-qty', 0)->attribute('id', $item->name)->placeholder("Select")->required() }}
                                            </td>
                                            <td>
                                                {{ html()->number('available_qty[]', '', 1, '', '1')->class("form-control form-control-lg qtyAvailable text-center")->placeholder("0")->disabled() }}
                                            </td>
                                            <td>
                                                {{ html()->number('qty[]', '', 1, '', '1')->class("form-control form-control-lg qtyMax text-center")->placeholder("0")->required() }}
                                            </td>
                                            <td class="text-center">
                                                <a href="javascript:void(0)" class="dltRow"><i class="fa fa-trash text-danger"></i></a>
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                    @empty
                                    @endforelse
                                </table>
                            </div>
                            <div class="col-md-6">
                                <label for="SquareInput" class="form-label ">Order Note</label>
                                {{ html()->text('notes', old('notes'))->class("form-control form-control-lg")->if($old != '', function($ele){
                                    return $ele->required()->placeholder("Order Note required since the order id has already been used");
                                }) }}
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col text-end">
                                {{ html()->submit("Place Order")->class("btn btn-submit btn-dark btn-lg") }}
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