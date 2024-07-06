<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PdfController extends Controller
{
    public function purchaseDetail(string $id)
    {
        $purchase = Purchase::findOrFail(decrypt($id));
        $qrcode = base64_encode(QrCode::format('svg')->size(75)->errorCorrection('H')->generate('https://devieh.com'));
        $pdf = PDF::loadView('pdf.purchase-detail', compact('purchase', 'qrcode'));
        return $pdf->stream('purchases.pdf');
    }
}
