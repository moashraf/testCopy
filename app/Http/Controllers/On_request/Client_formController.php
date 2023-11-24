<?php

namespace App\Http\Controllers\On_request;

use App\Http\Controllers\Controller;
use App\Http\Services\smsGateways\Whysms;
use App\Models\Basic\Client_form;
use App\Models\Branch\Appointment;
use App\Models\Branch\Branch;
use App\Models\Branch\Complaint;
use App\Models\Branch\On_request_item;
use App\Models\Branch\Online_request;
use App\Models\Branch\Package_booking;
use App\Models\Branch\Package_offer;
use App\Models\Branch\Trip_booking;
use App\Models\Branch\Trip_offer;
use App\Models\Branch\Unit_booking;
use App\Models\Branch\Unit_offer;
use App\Models\Branch\Unit_offer_price;
use App\Models\Branch\Visa;
use App\Models\Branch\Visa_booking;
use App\Models\Invoice\Coupon;
use App\Models\Invoice\Debtor;
use App\Models\Invoice\Invoice;
use App\Models\Invoice\Invoice_item;
use App\Models\Patient\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class Client_formController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $on_requests = Client_form::get();

        return view('client_form.index', compact('on_requests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'second_name' => 'required',
            'avatar' => ['image', 'mimes:jpeg,jpg,png', 'max:200'],
        ]);

        //insert img
        if ($request->hasFile('avatar')) {
            $file_extension = request()->avatar->getClientOriginalExtension();
            $file_name = 'deb' . $request->input('first_name') . time() . '.' . $file_extension;
            $path = 'img/useravatar';
            $request->avatar->move($path, $file_name);
        } else {
            $file_name = 'default-pp.png';
        };

        $debtor = Debtor::create([
            'first_name' => $request->input('first_name'),
            'second_name' => $request->input('second_name'),
            'avatar' => $file_name,
            'company_name' => $request->input('company_name'),
        ]);

        return redirect()->route('sett.debtorcat.index')
            ->with('success', 'Debtor has created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $on_request = Online_request::find($id);

        return view('on_request.show', compact('on_request'));
    }


    public function complaint_save_ajax(Request $request)
    {

        $complaint = Complaint::create([
            'appointment_id' => $request->input('appointment_id'),
            'body' => $request->input('body'),
        ]);

        if ($complaint) {
            return 'Thanks! for your feedback';
        } else {
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }



    public function on_request_change_status(request $request, $id)
    {

        $request_id = $request->input('request_id');

        $on_request = Online_request::find($id);

        $on_request->status = $request->input('status');
        $on_request->worker_note = $request->input('worker_note');
        $on_request->save();

        session()->flash('success', 'The request has been edited successfully');
        return redirect()->back();
    }


    public function generateRandomString($length = 20)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $form = Client_form::find($id);
        $form->delete();

        session()->flash('success', 'The request has been deleted successfully');
        return redirect()->back();
    }
    public function client_form_status(Request $request, $id)
    {
        $form = Client_form::find($id);
        $form->status = $request->input('status');
        $form->worker_id = Auth::id();
        $form->save();

        session()->flash('success', 'The request has been edited successfully');
        return redirect()->back();
    }
}
