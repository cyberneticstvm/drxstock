@extends("pdf.base")
@section("pdfcontent")
<div class="row">
    <div class="col">
        <h4 class="text-center">Product Purchase List</h4>
    </div>
    <div class="col">
        <table width="100%" class="mt-10" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th>SL No</th>
                    <th>Product Name</th>
                    <th>Product Code</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse($purchase->details as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->product?->name }}</td>
                    <td>{{ $item->product?->code }}</td>
                    <td class="text-end">{{ $item->qty }}</td>
                    <td class="text-end">{{ $item->unit_purchase_price }}</td>
                    <td class="text-end">{{ $item->total_purchase_price }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">
                        <h3 class="text-danger">No records found!</h3>
                    </td>
                    @endforelse
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end fw-bold">Total</td>
                    <td class="text-end fw-bold">{{ $purchase->details->sum('qty') }}</td>
                    <td class="text-end fw-bold">{{ number_format($purchase->details->sum('unit_purchase_price'), 2) }}</td>
                    <td class="text-end fw-bold">{{ number_format($purchase->details->sum('total_purchase_price'), 2) }}</td>
                </tr>
            </tfoot>
        </table>
        <div class="">
            <p>Purchase Note: {{ $purchase->purchase_note }}</p>
        </div>
    </div>
    <footer>
        Printed On: {{ Carbon\Carbon::now()->format('d, M Y h:i a') }}
    </footer>
</div>
@endsection