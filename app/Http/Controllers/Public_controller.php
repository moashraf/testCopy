<?php

namespace App\Http\Controllers;

use App\Models\Branch\Booking;
use App\Models\Invoice\Invoice;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Mpdf\Mpdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use PDF;

class Public_controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Created by: Antesko <https://github.com/antesko>
     * Date: 21.6.2016.
     */

    /**
     * HELPER FUNCTIONS
     */

    /**
     * Generates random string
     * @param int $length
     * @return string
     */


    //print 
    public function invoice_print($code)
    {

        $invoice = Invoice::where('code', $code)->first();


        if (!$invoice) {
            return abort(404);
        }

        $logo = public_path('img/dashboard/system/') . prox_sett('logo');

        $company_phone = prox_sett('company_phone_number');
        $company_address = prox_sett('company_address');
        $company_email = prox_sett('company_email');
        $invoice_rule = prox_sett('invoice_rule');

        $booking_url = route('invo_invoice_print', $invoice->code);
        $qrcode = base64_encode(QrCode::color(68, 95, 129)->size(80)->style('round')->eye('circle')->generate($booking_url));

        $html = view('invoice.print', compact('invoice', 'qrcode', 'invoice_rule'))->render();

        $mpdf = new Mpdf();

        $mpdf->SetHTMLHeader('<div class="heade">
        <div class="row">
        <div class="col-xs-9 m-0 ps-3">
            <img src="' . $logo . '">
            <p class="mt-1 mb-0 text-s fw-bold2 text-gray-600"><span class="text-gray-300">' . __('basic.number') . ': </span>' . $company_phone . '</p>
            <p class="mb-0 text-s fw-bold2 text-gray-600"><span class="text-gray-300">' . __('basic.address') . ': </span>' . $company_address . '</p>
        </div>
        <div class="col-xs-2 text-center m-0 ps-3">
            <img src="data:image/svg;base64,' . $qrcode . '">
            <p class="mb-0 text-s2 fw-bold2 text-gray-600">' . __('basic.invoice') . '</p>
            <p class="mt-0 mb-0 text-s fw-bold2">' . $invoice->code . '</p>
            <p class="mb-0 text-s fw-bold2">' . $invoice->new_id . '</p>
        </div>
        </div>
        </div>
        ', 'O');
        $mpdf->SetHTMLFooter('<hr><h5>Address: <span class="fw-bold2">' . $company_address . '</span></h5>' .
            '<h5>Phone: <span class="fw-bold2">' . $company_phone . '</span></h5>' .
            '<h5>Email: <span class="fw-bold2">' . $company_email . '</span></h5>' .
            '<div class"text-center"> Page {PAGENO} <span class="text-s">Copyright © 2023 Tripo, Developed
            by SHM</span> | {DATE j-m-Y}</div>');

        $mpdf->AddPageByArray([
            'margin-top' => 50,
            'margin-bottom' => 35,
        ]);
        $mpdf->WriteHTML($html);
        $mpdf->output();
    }


    //print 
    public function booking_print($code)
    {

        $appointment = Booking::where('code', $code)->first();

        if (!$appointment) {
            abort(404);
        }

        $logo = public_path('img/dashboard/system/') . prox_sett('logo');

        $company_phone = prox_sett('company_phone_number');
        $company_address = prox_sett('company_address');
        $company_email = prox_sett('company_email');
        $invoice_rule = prox_sett('invoice_rule');

        $booking_url = route('booking_print', $appointment->code);

        $qrcode = base64_encode(QrCode::color(68, 95, 129)->size(80)->style('round')->eye('circle')->generate($booking_url));

        $html = view('branch/appointment/print', compact('appointment', 'qrcode', 'invoice_rule'))->render();

        $mpdf = new Mpdf();

        $mpdf->SetHTMLHeader('<div class="heade">
        <div class="row">
        <div class="col-xs-9 m-0 ps-3">
            <img src="' . $logo . '">
            <p class="mt-1 mb-0 text-s fw-bold2 text-gray-600"><span class="text-gray-300">' . __('basic.number') . ': </span>' . $company_phone . '</p>
            <p class="mb-0 text-s fw-bold2 text-gray-600"><span class="text-gray-300">' . __('basic.address') . ': </span>' . $company_address . '</p>
        </div>
        <div class="col-xs-2 text-center m-0 ps-3">
            <img src="data:image/svg;base64,' . $qrcode . '">
            <p class="mb-0 text-s fw-bold2 text-gray-600">' . __('basic.booking voucher') . '</p>
            <p class="mt-0 mb-0 text-s fw-bold2">' . $appointment->code . '</p>
        </div>
        </div>
        </div>', 'O');
        $mpdf->SetHTMLFooter('<hr><h5>Address: <span class="fw-bold2">' . $company_address . '</span></h5>' .
            '<h5>Phone: <span class="fw-bold2">' . $company_phone . '</span></h5>' .
            '<h5>Email: <span class="fw-bold2">' . $company_email . '</span></h5>' .
            '<div class"text-center"> Page {PAGENO} <span class="text-s">Copyright © 2023 Tripo, Developed
            by SHM</span> | {DATE j-m-Y}</div>');

        $mpdf->AddPageByArray([
            'margin-top' => 50,
            'margin-bottom' => 35,
        ]);
        $mpdf->WriteHTML($html);
        $mpdf->output();
    }
}