<?php

namespace App\Http\Controllers;

use App\Mail\Basic_mail;
use App\Models\Admin\Attendance;
use App\Models\Branch\Appointment;
use App\Models\Branch\Booking;
use App\Models\Branch\Branch;
use App\Models\Branch\Currency;
use App\Models\Invoice\Invoice;
use App\Models\Invoice\Invoice_item;
use App\Models\Patient\Disease;
use App\Models\Patient\Medicine;
use App\Models\Patient\Patient;
use App\Models\Patient\Pulse;
use App\Models\Patient\Specialty_cat;
use App\Models\Patient\Treatment;
use App\Models\Prox_setting as ModelsProx_setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Image;

class Prox_setting extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $option = ModelsProx_setting::where('option_name', '!=', 'timeslotweekends')->get();

        $timeslotweekends = ModelsProx_setting::select('option_value')->where('option_name', 'timeslotweekends')->first();
        if ($timeslotweekends->option_value !== "null") {
            $weekends = unserialize($timeslotweekends->option_value);
        } else {
            $weekends = array();
        }

        $currencies = Currency::all();

        return view('option.index', compact('option', 'weekends', 'currencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $this->validate($request, [
            'companyname' => 'required',
            'companydescription' => 'required',
            'companylogo' => 'required',
            'timeslotduration' => 'required',
            'timeslotcleanup' => 'required',
            'timeslotstart' => 'required',
            'timeslotend' => 'required',
            'tax' => 'required',
            'currency' => 'required',
            'company_phone_number' => 'required',
            'company_address' => 'required',
            'company_email' => 'required',
            'company_commercial_register' => 'required',
            'company_tax_number' => 'required',
            'workinghours' => 'required',
            'logo' => 'nullable|sometimes|image|mimes:png|max:40|dimensions:width=167,height=107',
        ]);


        $client_name = prox_sett('companyname');
        $company_name = prox_sett('companyname');
        $company_logo = prox_sett('logo');

        $website_url = request()->getHost();
        $valid_url = $_ENV['valid_url'];

        //email send
        $details = [
            'subject' => "Access from Tripo system " . $website_url,
            'client_name' => "Shady Hesham",
            'company_logo' => $company_logo,
            'company_name' => $company_name,
            'description' => "Access from the following URL " . $website_url . " and the valid URL is " . $valid_url . " Company Name " . $client_name,
        ];

        $mail = Mail::to("systemtripo@gmail.com")->send(new Basic_mail($details));

        $clinic_name = ModelsProx_setting::where('option_name', 'companytype')->first();
        $clinic_name->option_value = $request->input('companytype');
        $clinic_name->save();

        $clinic_name = ModelsProx_setting::where('option_name', 'companyname')->first();
        $clinic_name->option_value = $request->input('companyname');
        $clinic_name->save();

        $clinic_description = ModelsProx_setting::where('option_name', 'companydescription')->first();
        $clinic_description->option_value = $request->input('companydescription');
        $clinic_description->save();

        $clinic_logo = ModelsProx_setting::where('option_name', 'companylogo')->first();
        $clinic_logo->option_value = $request->input('companylogo');
        $clinic_logo->save();

        $timeslot_duration = ModelsProx_setting::where('option_name', 'timeslotduration')->first();
        $timeslot_duration->option_value = $request->input('timeslotduration');
        $timeslot_duration->save();

        $timeslot_cleanup = ModelsProx_setting::where('option_name', 'timeslotcleanup')->first();
        $timeslot_cleanup->option_value = $request->input('timeslotcleanup');
        $timeslot_cleanup->save();

        $timeslot_start = ModelsProx_setting::where('option_name', 'timeslotstart')->first();
        $timeslot_start->option_value = $request->input('timeslotstart');
        $timeslot_start->save();

        $timeslot_end = ModelsProx_setting::where('option_name', 'timeslotend')->first();
        $timeslot_end->option_value = $request->input('timeslotend');
        $timeslot_end->save();

        $timeslot_end = ModelsProx_setting::where('option_name', 'workinghours')->first();
        $timeslot_end->option_value = $request->input('workinghours');
        $timeslot_end->save();

        $timeslot_end = ModelsProx_setting::where('option_name', 'tax')->first();
        $timeslot_end->option_value = $request->input('tax');
        $timeslot_end->save();

        $timeslot_end = ModelsProx_setting::where('option_name', 'currency')->first();
        $timeslot_end->option_value = $request->input('currency');
        $timeslot_end->save();

        $clinic_logo = ModelsProx_setting::where('option_name', 'company_phone_number')->first();
        $clinic_logo->option_value = $request->input('company_phone_number');
        $clinic_logo->save();

        $clinic_logo = ModelsProx_setting::where('option_name', 'company_address')->first();
        $clinic_logo->option_value = $request->input('company_address');
        $clinic_logo->save();

        $clinic_logo = ModelsProx_setting::where('option_name', 'company_email')->first();
        $clinic_logo->option_value = $request->input('company_email');
        $clinic_logo->save();

        $clinic_logo = ModelsProx_setting::where('option_name', 'company_commercial_register')->first();
        $clinic_logo->option_value = $request->input('company_commercial_register');
        $clinic_logo->save();

        $clinic_logo = ModelsProx_setting::where('option_name', 'company_tax_number')->first();
        $clinic_logo->option_value = $request->input('company_tax_number');
        $clinic_logo->save();


        $clinic_logo = ModelsProx_setting::where('option_name', 'invoice_rule')->first();
        $clinic_logo->option_value = $request->input('invoice_rule');
        $clinic_logo->save();

        $clinic_logo = ModelsProx_setting::where('option_name', 'quotation_rule')->first();
        $clinic_logo->option_value = $request->input('quotation_rule');
        $clinic_logo->save();

        $clinic_logo = ModelsProx_setting::where('option_name', 'google_search_console')->first();
        $clinic_logo->option_value = $request->input('google_search_console');
        $clinic_logo->save();

        $clinic_logo = ModelsProx_setting::where('option_name', 'facebook_pixel')->first();
        $clinic_logo->option_value = $request->input('facebook_pixel');
        $clinic_logo->save();

        if (!empty($request->input('timeslotweekends'))) {
            $timeslot_weekends = ModelsProx_setting::where('option_name', 'timeslotweekends')->first();
            $timeslot_weekends_array = serialize($request->input('timeslotweekends'));
            $timeslot_weekends->option_value = $timeslot_weekends_array;
            $timeslot_weekends->save();
        } else {
            $timeslot_weekends = ModelsProx_setting::where('option_name', 'timeslotweekends')->first();
            $timeslot_weekends->option_value = 'null';
            $timeslot_weekends->save();
        }


        if ($request->hasFile('logo')) {

            $logo_qu = ModelsProx_setting::where('option_name', 'logo')->first();

            //to remove the old img
            $imagePath = public_path('img/dashboard/system/' . $logo_qu->option_value);
            File::delete($imagePath);

            $file_extension = $request->file('logo')->getClientOriginalExtension();

            $file_name = $logo_qu->option_value;

            $path = public_path('img/dashboard/system/' . $file_name);

            Image::make($request->logo)
                ->save($path);
        }

        return redirect()->route('sett.options.index')
            ->with('success', 'Option has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    public function livereport(Request $request)
    {

        if (!empty($request->input('specialty'))) {
            $specialty = $request->input('specialty');
        } else {
            $specialty = 'all';
        }
        if (!empty($request->input('branch'))) {
            $branch = $request->input('branch');
        } else {
            $branch = 'all';
        }
        if (!empty($request->input('day_date'))) {
            $from = $request->input('day_date');
        } else {
            $from = 'all';
        }

        $specialty_cat = Specialty_cat::all();
        $branches = Branch::all();

        // ----------------------  Appointments ----------------------

        $appointment_total = Booking::select('id');

        if ($branch !== "all") {
            $appointment_total = $appointment_total->where('branch_id', $branch);
        }

        if ($from !== "all") {
            $appointment_total = $appointment_total->whereDate('created_at', $from);
        } else {
            $appointment_total = $appointment_total->whereDate('created_at', Carbon::today());
        }

        $appointment_total = $appointment_total->count();

        //----

        $appointment_branch = Booking::select('branch_id', DB::raw('count(*) as total'))
            ->groupBy('branch_id')
            ->with(['branch' => function ($q) {
                $q->select('id', 'name');
            }])
            ->limit(11)
            ->orderBy('total', 'DESC');

        if ($specialty !== "all") {
            $appointment_branch = $appointment_branch->where('specialty_id', $specialty);
        }

        if ($from !== "all") {
            $appointment_branch = $appointment_branch->whereDate('created_at', $from);
        } else {
            $appointment_branch = $appointment_branch->whereDate('created_at', Carbon::today());
        }

        $appointment_branch = $appointment_branch->get();

        //---

        $appointment_status = Booking::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->limit(11)
            ->orderBy('total', 'DESC');

        if ($specialty !== "all") {
            $appointment_status = $appointment_status->where('specialty_id', $specialty);
        }

        if ($from !== "all") {
            $appointment_status = $appointment_status->whereDate('created_at', $from);
        } else {
            $appointment_status = $appointment_status->whereDate('created_at', Carbon::today());
        }

        $appointment_status = $appointment_status->get();

        // ----------------------  Patients ----------------------

        $patient_branches = Manager::select('first_branch_id', DB::raw('count(*) as total'))
            ->groupBy('first_branch_id')
            ->with(['branch' => function ($q) {
                $q->select('id', 'name');
            }])
            ->limit(11)
            ->orderBy('total', 'DESC');

        if ($from !== "all") {
            $patient_branches = $patient_branches->whereDate('created_at', $from);
        } else {
            $patient_branches = $patient_branches->whereDate('created_at', Carbon::today());
        }

        $patient_branches = $patient_branches->get();


        // ----------------------  accounting ----------------------

        $total_incoime = Invoice::where('type', 0)
            ->whereIn('status', [1, 2]);

        if ($specialty !== "all") {
            $total_incoime = $total_incoime->where('specialty_id', $specialty);
        }

        if ($branch !== "all") {
            $total_incoime = $total_incoime->where('branch_id', $branch);
        }

        if ($from !== "all") {
            $total_incoime = $total_incoime->whereDate('paid_date', $from);
        } else {
            $total_incoime = $total_incoime->whereDate('paid_date', Carbon::today());
        }

        $total_incoime = $total_incoime->sum('total_paid');


        $total_expenses = Invoice::where('type', 1)
            ->whereIn('status', [1, 2]);

        if ($specialty !== "all") {
            $total_expenses = $total_expenses->where('specialty_id', $specialty);
        }

        if ($branch !== "all") {
            $total_expenses = $total_expenses->where('branch_id', $branch);
        }

        if ($from !== "all") {
            $total_expenses = $total_expenses->whereDate('paid_date', $from);
        } else {
            $total_expenses = $total_expenses->whereDate('paid_date', Carbon::today());
        }

        $total_expenses = $total_expenses->sum('total_paid');

        // ---------------------- workers ----------------------

        $creator = Booking::select('creator_id', DB::raw('count(*) as total'))
            ->groupBy('creator_id')
            ->with(['creator' => function ($q) {
                $q->select('id', DB::raw('CONCAT(first_Name, " ", second_Name) AS name'));
            }])
            ->whereNotNull('creator_id')
            ->limit(11)
            ->orderBy('total', 'DESC');

        if ($specialty !== "all") {
            $creator = $creator->where('specialty_id', $specialty);
        }

        if ($branch !== "all") {
            $creator = $creator->where('branch_id', $branch);
        }

        if ($from !== "all") {
            $creator = $creator->whereDate('created_at', $from);
        } else {
            $creator = $creator->whereDate('created_at', Carbon::today());
        }

        $creator = $creator->get();

        // ---------------------- 
        $confirmation = Booking::select('last_update_person_id', DB::raw('count(*) as total'))
            ->groupBy('last_update_person_id')
            ->with(['last_update_person' => function ($q) {
                $q->select('id', DB::raw('CONCAT(first_Name, " ", second_Name) AS name'));
            }])
            ->whereNotNull('last_update_person_id')
            ->limit(11)
            ->orderBy('total', 'DESC');

        if ($specialty !== "all") {
            $confirmation = $confirmation->where('specialty_id', $specialty);
        }

        if ($branch !== "all") {
            $confirmation = $confirmation->where('branch_id', $branch);
        }

        if ($from !== "all") {
            $confirmation = $confirmation->whereDate('created_at', $from);
        } else {
            $confirmation = $confirmation->whereDate('created_at', Carbon::today());
        }

        $confirmation = $confirmation->get();


        // ---------------------- 

        // $accountant1 = Invoice::select('responsible_worker', DB::raw('count(*) as total'))
        // ->groupBy('responsible_worker')
        // ->with(['worker' => function ($q) {
        //     $q->select('id', DB::raw('CONCAT(first_Name, " ", second_Name) AS name'));}])
        // ->whereNotNull('responsible_worker')
        // ->limit(11)
        // ->whereIn('status', '!=', )
        // ->orderBy('total', 'DESC');

        // if($specialty !== "all"){
        //     $accountant1 = $accountant1->where('specialty_id', $specialty);
        // }

        // if($branch !== "all"){
        //     $accountant1 = $accountant1->where('branch_id', $branch);
        // }

        // if($from !== "all"){
        //     $accountant1 = $accountant1->whereDate('paid_date', $from);
        // }else{
        //     $accountant1 = $accountant1->whereDate('paid_date', Carbon::today());
        // }

        // $accountant1 = $accountant1->get();


        //expenses
        $accountant = Invoice::select('invoices.id', 'payments.amount', DB::raw('sum(payments.amount) as sums'))
            ->join('payments', 'invoices.id', '=', 'payments.invoice_id')
            ->where('invoices.type', 0)
            ->where('invoices.status', '!=', 0)
            ->where('payments.type', 3)
            ->groupBy('payments.worker_id');


        if ($specialty !== "all") {
            $accountant = $accountant->where('invoices.specialty_id', $specialty);
        }

        if (Auth::user()->branch_id == 0) {
            if ($branch !== "all") {
                $accountant = $accountant->where('invoices.branch_id', $branch);
            }
        } else {
            $accountant = $accountant->where('invoices.branch_id', Auth::user()->branch_id);
        }

        if ($from !== "all") {
            $accountant = $accountant->whereDate('payments.paid_date', $from)
                ->with(['payment' => function ($q) use ($from) {
                    $q->select('id', 'invoice_id', 'type', 'method', 'amount', 'responsible_worker', 'paid_date')
                        ->with(['worker' => function ($q) {
                            $q->select('id', DB::raw('CONCAT(first_Name, " ", second_Name) AS name'));
                        }]);
                }]);
        } else {
            $accountant = $accountant->whereDate('payments.paid_date', Carbon::today())
                ->with(['payment' => function ($q) use ($from) {
                    $q->select('id', 'invoice_id', 'type', 'method', 'amount', 'responsible_worker', 'paid_date')
                        ->with(['worker' => function ($q) {
                            $q->select('id', DB::raw('CONCAT(first_Name, " ", second_Name) AS name'));
                        }]);
                }]);
        }

        $accountant = $accountant->get();

        // ---------------------- 

        $atten = Attendance::with(['worker' => function ($q) {
            $q->select('id', DB::raw('CONCAT(first_Name, " ", second_Name) AS name'));
        }])
            ->with(['branch' => function ($q) {
                $q->select('id', 'name');
            }])
            ->orderBy('arrived_time', 'ASC');

        if ($from !== "all") {
            $atten = $atten->whereDate('arrived_time', $from);
        } else {
            $atten = $atten->whereDate('arrived_time', Carbon::today());
        }

        $atten = $atten->get();

        $fixed_working_hours = prox_sett('workinghours');

        return view('reports/livereport', compact('specialty_cat', 'branches', 'specialty', 'branch', 'appointment_total', 'appointment_branch', 'appointment_status', 'patient_branches', 'creator', 'confirmation', 'accountant', 'from', 'atten', 'fixed_working_hours'));
    }


    public function service_report(Request $request)
    {

        if (!empty($request->input('specialty'))) {
            $specialty = $request->input('specialty');
        } else {
            $specialty = 'all';
        }
        if (!empty($request->input('branch'))) {
            $branch = $request->input('branch');
        } else {
            $branch = 'all';
        }
        if (!empty($request->input('from'))) {
            $from = $request->input('from');
        } else {
            $from = 'all';
        }
        if (!empty($request->input('to'))) {
            $to = $request->input('to');
        } else {
            $to = 'all';
        }

        $specialty_cat = Specialty_cat::all();
        $branches = Branch::all();

        $profit = Invoice_item::select('invoice_id', 'categorizable_id', 'categorizable_type', DB::raw('sum(paid) as sums'))
            ->with(['categorizable' => function ($q) {
                $q->select('id', 'name');
            }])
            ->limit(40)
            ->groupBy('categorizable_id', 'categorizable_type');

        if ($specialty !== "all") {
            $profit = $profit->whereHas('invoice', function ($q) use ($specialty) {
                $q->where('type', 0)->select('id')
                    ->whereIn('status', [1, 2])
                    ->where('specialty_id', $specialty);
            });
        } else {
            $profit = $profit->whereHas('invoice', function ($q) use ($specialty) {
                $q->where('type', 0)->select('id')
                    ->whereIn('status', [1, 2]);
            });
        }

        if ($branch !== "all") {
            $profit = $profit->whereHas('invoice', function ($q) use ($branch) {
                $q->where('type', 0)->select('id')
                    ->where('branch_id', $branch)
                    ->whereIn('status', [1, 2]);
            });
        } else {
            $profit = $profit->whereHas('invoice', function ($q) use ($specialty) {
                $q->where('type', 0)->select('id')
                    ->whereIn('status', [1, 2]);
            });
        }

        if ($from !== "all") {
            $profit = $profit->whereHas('invoice', function ($q) use ($from, $to) {
                $q->where('type', 0)->select('id')
                    ->whereBetween('paid_date', [
                        Carbon::createFromFormat('m-Y', $from)->startOfMonth(), //2022-10-01 00:00:00.0
                        Carbon::createFromFormat('m-Y', $to)->endOfMonth() // 2022-10-31 23:59:59.999999
                    ])
                    ->whereIn('status', [1, 2]);
            });
        } else {
            $profit = $profit->whereHas('invoice', function ($q) use ($from, $to) {
                $q->where('type', 0)->select('id')
                    ->whereYear('paid_date', date('Y'));
            });
        }

        $profit = $profit->get();


        return view('reports/services', compact('specialty_cat', 'branches',  'specialty', 'branch', 'profit', 'from', 'to'));
    }
}
