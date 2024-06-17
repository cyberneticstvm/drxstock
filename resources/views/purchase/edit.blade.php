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
                        <li class="breadcrumb-item active" aria-current="page">Update Purchase</li>
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
                {{ html()->form('POST', route('purchase.update', $purchase->id))->open() }}
                <div class="card bg-white">
                    <div class="card-header py-3 border-bottom-0">
                        <h6 class="card-title mb-0">Update Purchase</h6>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-5">
                                <label for="SquareInput" class="form-label req">Supplier</label>
                                {{ html()->select('supplier_id', $suppliers, $purchase->supplier_id)->class("form-control form-control-lg select2")->placeholder("Select") }}
                                @error('supplier_id')
                                <small class="text-danger">{{ $errors->first('supplier_id') }}</small>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <label for="SquareInput" class="form-label ">Supplier Invoice</label>
                                {{ html()->text('supplier_invoice', $purchase->supplier_invoice)->class("form-control form-control-lg")->placeholder("Supplier Invoice") }}
                            </div>
                            <div class="col-md-2">
                                <label for="SquareInput" class="form-label ">Supplier Invoice</label>
                                {{ html()->date('order_date', $purchase->order_date?->format('Y-m-d'))->class("form-control form-control-lg")->placeholder(date('Y-m-d')) }}
                            </div>
                            <div class="col-md-2">
                                <label for="SquareInput" class="form-label ">Supplier Invoice</label>
                                {{ html()->date('delivery_date', $purchase->delivery_date?->format('Y-m-d'))->class("form-control form-control-lg")->placeholder(date('Y-m-d')) }}
                            </div>
                            <div class="col-md-5">
                                <label for="SquareInput" class="form-label ">Purchase Note</label>
                                {{ html()->text('purchase_note', $purchase->purchase_note)->class("form-control form-control-lg")->placeholder("Purchase Note") }}
                            </div>
                        </div>
                    </div>
                    <div class="card-header py-3 border-bottom-0">
                        <div class="row">
                            <div class="col-6">
                                <h6 class="card-title mb-0">Product Details</h6>
                            </div>
                            <div class="col-6 text-end"><a href="javascript:void(0)" class="addNewProduct">Add New Product</a></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="60%">Product</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-end">Unit Pur. Price</th>
                                            <th class="text-end">Unit Sell. Price</th>
                                            <th class="text-center">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody class="pdctPurRow">
                                        @forelse($purchase->details as $key => $item)
                                        <tr>
                                            <td>
                                                {{ html()->select('product_id[]', $products, $item->product_id)->class("form-control form-control-lg select2 selProduct")->placeholder("Select") }}
                                            </td>
                                            <td>
                                                {{ html()->number('qty[]', $item->qty, 1, '', '1')->class("form-control form-control-lg text-center")->placeholder("0") }}
                                            </td>
                                            <td>
                                                {{ html()->number('unit_purchase_price[]', $item->unit_purchase_price, 0, '', 'any')->class("form-control form-control-lg text-end")->placeholder("0") }}
                                            </td>
                                            <td>
                                                {{ html()->number('unit_selling_price[]', $item->unit_selling_price, 0, '', 'any')->class("form-control form-control-lg text-end")->placeholder("0") }}
                                            </td>
                                            <td class="text-center">
                                                <a href="javascript:void(0)" class="dltRow"><i class="fa fa-trash text-danger"></i></a>
                                            </td>
                                        </tr>
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col text-end">
                                {{ html()->submit("Update Purchase")->class("btn btn-submit btn-dark btn-lg") }}
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