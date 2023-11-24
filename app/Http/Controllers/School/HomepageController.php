<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatientRequest;
use App\Http\Services\smsGateways\Whysms;
use App\Models\Branch\Appointment;
use App\Models\Branch\Appointment\Rate_appointment;
use App\Models\Branch\Branch;
use App\Models\Branch\Lab;
use App\Models\Branch\Package;
use App\Models\Branch\Slider;
use App\Models\Branch\Tag;
use App\Models\Branch\Trip;
use App\Models\Branch\Unit;
use App\Models\Branch\Unit_offer;
use App\Models\Branch\Unit_tag;
use App\Models\Branch\Visa;
use App\Models\Cat\Article\Article;
use App\Models\Basic\Client_form;
use App\Models\Invoice\Coupon;
use App\Models\Invoice\Invoice;
use App\Models\Invoice\Invoice_item;
use App\Models\location\City;
use App\Models\location\Country;
use App\Models\Patient\Cancel_reason_cat;
use App\Models\Patient\Destination;
use App\Models\Patient\From_recourse;
use App\Models\Patient\Image_destination;
use App\Models\Patient\Medicine;
use App\Models\Patient\Patient;
use App\Models\Patient\Service_item;
use App\Models\Patient\Specialty_cat;
use App\Models\Patient\Treatment;
use App\Models\Verification_code;
use App\Rules\CouponRule;
use App\Rules\Recaptcha;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use App\Models\Patient\Service_inv_cat as PatientService_inv_cat;


class HomepageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {

        return redirect()->route('school_route.login');


        return view('website.homepage.index', compact('main_slider', 'weekly_slider', 'top_destination',  'random_destination_units', 'best_package', 'best_unit_first', 'best_unit_second', 'trip', 'visa', 'full_package', 'articles'));
    }


    public function login()
    {
        return view('website/auth/login');
    }

    public function login_sub(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'phone_number'   => 'required|numeric',
            'password' => 'required',
            // 'g-recaptcha-response' => ['required', new Recaptcha()],
        ]);

        // Attempt to log the user in
        if (Auth::guard('school')->attempt(['phone_number' => $request->phone_number, 'password' => $request->password], $request->remember)) {
            $request->session()->regenerate();
            // if successful, then redirect to their intended location
            return redirect()->intended(route('school_route.dashboard'));
        }

        // if unsuccessful, then redirect back to the login with the form data
        return back()->withErrors([
            'phone_number' => 'Your Phone number or Password is not correct!',
        ]);
    }


    function logout()
    {
        Auth::guard('school')->logout();
        return redirect()->route('landing');
    }



    public function register()
    {
        return view('website.auth.register');
    }


    //for select input ajax to send the cities beasd on the given country
    public function createcityajax($id)
    {
        return City::where('country_id', $id)->get();
    }


    // public function store(Request $request){

    //     // dd($request->all());
    //     $this->validate($request, [
    //         'password'=>'required',
    //         'email'=>'required',
    //         'first_name'=>'required',
    //         'second_name'=>'required',
    //         'avatar'=>'required',
    //         'phone'=>'required',
    //     ]);

    //     // insert img
    //     if($request->hasFile('avatar')){
    //         $file_extension = request()->avatar->getClientOriginalExtension();
    //         $file_name = $request->input('first_name') . time() . '.' . $file_extension;
    //         $path = 'img/useravatar';
    //         $request->avatar->move($path, $file_name);
    //     }
    //     else{
    //         $file_name = 'default-pp.png';
    //     };

    //     $user = Manager::create([
    //         'avatar' => $file_name,
    //         'email' => $request->input('email'),
    //         'password' => bcrypt($request->input('password')),
    //         'first_name' => $request->input('first_name'),
    //         'second_name' => $request->input('second_name'),
    //         'phone' => $request->input('phone'),
    //      ]);

    //      Auth::guard('school')->login($user);

    //     session()->flash('success', 'The patient has been created successfully');
    //     return redirect()->route('proxima_cli.dashboard');
    // }


    //for otp generation
    public function generateOtp($mobile_no)
    {

        $patient = Manager::where('phone_number', $mobile_no)->first();

        # User Does not Have Any Existing OTP
        $verificationCode = Verification_code::where('patient_id', $patient->id)->latest()->first();

        $now = Carbon::now();

        if ($verificationCode && $now->isBefore($verificationCode->expire_at)) {
            return $verificationCode;
        }

        // Create a New OTP
        return Verification_code::create([
            'patient_id' => $patient->id,
            'otp' => rand(1234, 9999),
            'expire_at' => Carbon::now()->addMinutes(10)
        ]);
    }



    public function register_with_otp(Request $request)
    {

        $patient_id = Auth::guard('school')->id();
        $digits =  $request->input('digits');

        #Validation Logic
        $verification_code  = Verification_code::where('patient_id', $patient_id)->where('otp', $digits)->first();

        $now = Carbon::now();

        if (!$verification_code) {
            return response()->json([
                "status" => false,
                "msg" => "Your OTP is not correct",
            ]);
        } elseif ($verification_code && $now->isAfter($verification_code->expire_at)) {
            return response()->json([
                "status" => false,
                "msg" => "Your OTP has been expired",
            ]);
        } else {
            $patient = Manager::find($patient_id);

            if ($patient) {
                // Expire The OTP
                $verification_code->update([
                    'expire_at' => Carbon::now()
                ]);

                $patient->inactive = 0;
                $patient->save();

                return response()->json([
                    "status" => true,
                    "msg" => "Your OTP has been confirmed",
                    "url" => route("school_route.edit_profile"),
                ]);
            } else {
                return response()->json([
                    "status" => false,
                    "msg" => "asdasd",
                ]);
            }
        }
    }







    public function destroy(Request $request)
    {
        $id =  $request->input('city_id');
        $region = Manager::find($id);
        $region->delete();
        session()->flash('success', 'The user has been deleted');
        return redirect()->route('website.client.my_account');
    }


    public function appointment()
    {
        $specialties = Specialty_cat::all();
        $branches = Branch::all();
        $services = Service_item::where('service_inv_cat_id', 1)->get();

        return view('landing/appointment', compact('specialties', 'branches', 'services'));
    }


    //select the calander data and funcation via ajax in creating
    public function calander_appointment_ajax($month, $year, $specialty_id, $branch_id, $unit_id)
    {

        if (isset(request()->month) && isset(request()->year)) {
            $month = request()->month;
            $year = request()->year;
        } else {
            $dateComponents = getdate();
            $month = $dateComponents['mon'];
            $year = $dateComponents['year'];
        }

        $duration = prox_sett('timeslotduration');
        $cleanup = prox_sett('timeslotcleanup');
        $start = prox_sett('timeslotstart');
        $end = prox_sett('timeslotend');

        if (prox_sett('timeslotweekends') !== "null") {
            $weekends = unserialize(prox_sett('timeslotweekends'));
        } else {
            $weekends = array();
        }

        if ($unit_id !== 'null') {
            return build_calendar($month, $year, $specialty_id, $branch_id, $unit_id, $duration, $cleanup, $start, $end, $weekends);
        } else {
            return "<p class='text-white mb-0'>Sorry, there is no unit related to this branch</p>";
        }
    }


    //fetch servcies besed on speicilty
    public function fetch_servicecat_ajax($specialty_id, $branch_id)
    {
        $service = Service_item::where('service_inv_cat_id', 1)
            ->where('specialty_id', $specialty_id);

        if (Auth::user()->branch_id !== 0) {
            $service = $service->whereIn('branch_id', [$branch_id, '0']);
        }

        $service = $service->get();

        return $service;
    }

    //fetch servcies besed on speicilty
    public function land_fetch_unit_ajax($branch_id)
    {

        $unit = Unit::where('branch_id', $branch_id);

        $unit = $unit->get();

        return $unit;
    }


    //select the calander data and funcation via ajax in creating
    public function calander_show_slots_ajax($datetoday, $specialty_id, $branch_id, $unit_id)
    {

        $duration = prox_sett('timeslotduration');
        $cleanup = prox_sett('timeslotcleanup');
        $start = prox_sett('timeslotstart');
        $end = prox_sett('timeslotend');

        return showSlots($duration, $cleanup, $start, $end, $datetoday, $specialty_id, $branch_id, $unit_id);
    }


    public function website_search($search_query)
    {

        $search_query = request()->search_query;

        $patient = Destination::select('id', 'name')
            ->where(function ($query) use ($search_query) {
                $query
                    ->orWhere('name', 'like', "%{$search_query}%");
            })
            ->limit(5);

        $patient = $patient->get();

        $unit = Unit::select('id', 'name')
            ->where(function ($query) use ($search_query) {
                $query
                    ->orWhere('name', 'like', "%{$search_query}%");
            })
            ->limit(5);

        $unit = $unit->get();

        //merge 2 collections
        $patient = $patient->merge($unit);

        $visa = Visa::select('id', 'name')
            ->where(function ($query) use ($search_query) {
                $query
                    ->orWhere('name', 'like', "%{$search_query}%");
            })
            ->limit(5);

        $visa = $visa->get();

        //merge 2 collections
        $patient = $patient->merge($visa);

        return $patient;
    }

    public function coupon_search($search_query, $patient_id, $total_price)
    {
        $search_query = request()->search_query;
        $coupon = Coupon::where('code', $search_query)->where('status', '1')->first();

        //if it is empty
        if (!$coupon) {
            $msg = "Sorry! invalid or expired coupon";
            return array('msg' => $msg);
        } else {
            $discount_amount = $coupon->discount($total_price);
            $coupon_id = $coupon->id;

            if ($patient_id === 'null') {
                $msg = "Coupon has been applied";
                $result = array('msg' => $msg, 'discount_amount' => $discount_amount, 'id' => $coupon_id);
                return $result;
            } else {

                $used_coupon = Invoice::where('coupon_id', $coupon_id)->where('receivable_id', $patient_id)->where('receivable_type', 'App\Models\Patient\Patient')->first();

                if (empty($used_coupon)) {
                    $msg = "Coupon has been applied";
                    $result = array('msg' => $msg, 'discount_amount' => $discount_amount, 'id' => $coupon_id);
                    return $result;
                } else {
                    $msg = "Sorry! You have used this coupon before";
                    return array('msg' => $msg);
                }
            }
        }
    }

    public function store_appointment(Request $request)
    {
        // the valdiation is in (app/requests/PatientRequest)

        $patient_id = Auth::guard('school')->id();

        $this->validate($request, [
            'calander_date_day' => ['required'],
            'branch_id' => ['required', 'exists:branches,id'],
            'unit_id' => ['required', 'exists:units,id'],
            'service_id' => ['required', 'exists:service_items,id'],
            'coupon_id' => ['nullable', 'exists:coupons,id', new CouponRule($patient_id)],
            'appointment_note' => ['nullable', 'max:200'],
        ]);

        $patient_id = $request->input('search_patient_id');

        $calander_date_day = $request->input('calander_date_day');

        $calander_date_start = date("H:i", strtotime($request->input('calander_date_start')));

        //for only selecting start slot without end slot
        if ($request->input('calander_date_end')) {
            $calander_date_end = date("H:i", strtotime($request->input('calander_date_end')));
        } else {
            $duration = prox_sett('timeslotduration');
            $cleanup = prox_sett('timeslotcleanup');
            $calander_date_start_end =  $duration + $cleanup;
            $calander_date_end = Carbon::parse($calander_date_start)->addMinutes($calander_date_start_end);
            $calander_date_end = Carbon::parse($calander_date_start)->addMinutes($calander_date_start_end)->format("H:i");
        }

        $start_at = $calander_date_day . ' ' . $calander_date_start;
        $end_at = $calander_date_day . ' ' . $calander_date_end;

        $service_id = $request->input('service_id');
        $branch_id = $request->input('branch_id');
        $unit_id = $request->input('unit_id');
        $coupon_id = $request->input('coupon_id');

        $service_price = Service_item::select('id', 'name', 'service_inv_cat_id', 'price')->where('id', $service_id)->first();

        if (!empty($coupon_id)) {
            $coupon = Coupon::find($coupon_id);
            $discount_amount = $coupon->discount($service_price->price);
            $final_price = $service_price->price - $discount_amount;
        } else {
            $discount_amount = null;
            $final_price = $service_price->price;
        }

        $appointment = Appointment::create([
            'code' => "AP" . $this->generateRandomString(6),
            'specialty_id' => $request->input('specialty_id'),
            'branch_id' => $branch_id,
            'unit_id' => $unit_id,
            'patient_id' => $patient_id,
            'services_cat_id' => $service_id,
            'start_at' => $start_at,
            'end_at' => $end_at,
            'note' => $request->input('appointment_note'),
        ]);

        $invoice = Invoice::create([
            'code' => "IN" . $this->generateRandomString(6),
            'service_inv_cat_id' => $service_price->service_inv_cat_id,
            'specialty_id' => $request->input('specialty_id'),
            'receivable_id' => $patient_id,
            'receivable_type' => "App\Models\Patient\Patient",
            'branch_id' => $branch_id,
            'items_price' => $service_price->price,
            'final_price' => $final_price,
            'coupon_id' => $coupon_id,
            'discount' => $discount_amount,
        ]);

        $patient = Manager::select('id', 'type', 'first_name', 'phone_number')->find($patient_id);
        $patient->type = 2;
        $patient->save();

        $invoice_item = Invoice_item::create([
            'invoice_id' => $invoice->id,
            'itemable_id' => $appointment->id,
            'itemable_type' => "App\Models\Branch\Appointment",
            'categorizable_id' => $service_id,
            'categorizable_type' => "App\Models\Patient\Service_item",
            'subtotal' => $final_price,
            'price' => $service_price->price,
        ]);

        session()->flash('success', 'The appointment has been created successfully');
        return redirect()->route('school_route.profile');
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

    public function about()
    {
        return view('landing/about');
    }

    public function contact()
    {
        return view('landing/contact');
    }

    public function blogs()
    {
        return view('landing/blogs');
    }


    public function show_pat_appointment_public($code)
    {

        $appointment = Appointment::select('id', 'code', 'patient_id', 'branch_id', 'doctor_id', 'services_cat_id', 'creator_id', 'status', 'start_at', 'end_at')
            ->with(['patient' => function ($q) {
                $q->select('id', 'phone_number', 'avatar', DB::raw('CONCAT(first_Name, " ", second_Name) AS name'));
            }])
            ->with(['branch' => function ($q) {
                $q->select('id', 'name', 'address');
            }])
            ->with(['creator' => function ($q) {
                $q->select('id', DB::raw('CONCAT(first_Name, " ", second_Name) AS name'));
            }])

            ->with(['invoice_item' => function ($q) {
                $q->select('id', 'invoice_id', 'itemable_id', 'itemable_type', 'price')
                    ->with(['invoice' => function ($q) {
                        $q->select('id', 'final_price');
                    }]);
            }])

            ->with(['service_item' => function ($q) {
                $q->select('id', 'name');
            }])
            ->where('code', $code)
            ->first();

        return view('landing/appointment_public', compact('appointment'));
    }


    public function rate_appo_public($code)
    {

        $appointment = Appointment::select('id', 'code', 'patient_id', 'branch_id', 'doctor_id', 'services_cat_id', 'creator_id', 'status', 'start_at', 'end_at')
            ->with(['patient' => function ($q) {
                $q->select('id', 'phone_number', 'avatar', DB::raw('CONCAT(first_Name, " ", second_Name) AS name'));
            }])
            ->with(['branch' => function ($q) {
                $q->select('id', 'name', 'address');
            }])
            ->with(['doctor' => function ($q) {
                $q->select('id', DB::raw('CONCAT(first_Name, " ", second_Name) AS name'));
            }])
            ->with(['creator' => function ($q) {
                $q->select('id', DB::raw('CONCAT(first_Name, " ", second_Name) AS name'));
            }])
            ->with(['service_item' => function ($q) {
                $q->select('id', 'name');
            }])
            ->doesnthave('rate')
            ->where('code', $code)
            ->first();

        if ($appointment) {
            $status = 1;
        } else {
            $status = 2;
        }

        $cancel_reasons = Cancel_reason_cat::all();

        return view('landing/rate_appo_public', compact('appointment', 'status', 'cancel_reasons'));
    }


    public function rate_appo_public_store(Request $request)
    {
        $this->validate($request, [
            'rate_type' => Rule::in([1, 2]),
            'service' => Rule::in([1, 2, 3, 4, 5]),
            'doctor' => Rule::in([1, 2, 3, 4, 5]),
            'time' => Rule::in([1, 2, 3, 4, 5]),
            'cleanliness' => Rule::in([1, 2, 3, 4, 5]),
            'appointment_code_input' => 'required|exists:appointments,code',
            'cancel_cat_id' => 'sometimes|required|exists:cancel_reason_cats,id',
            'note' => 'max:255',
        ]);

        $appointment = Appointment::select('id', 'start_at')->where('code', $request->input('appointment_code_input'))->get();


        if ($request->input('rate_type') == 1) {

            $rate = Rate_appointment::create([
                'appointment_id' => $appointment[0]->id,
                'type' => 1,
                'service' => $request->input('rate_service'),
                'doctor' => $request->input('rate_doctor'),
                'reception' => $request->input('rate_reception'),
                'time' => $request->input('rate_time'),
                'cleanliness' => $request->input('rate_cleanliness'),
                'note' => $request->input('rate_note'),
                'appointment_date' => $appointment[0]->start_at,
            ]);
        } else {
            $rate = Rate_appointment::create([
                'appointment_id' => $appointment[0]->id,
                'type' => 2,
                'cancel_cat_id' => $request->input('reason'),
                'note' => $request->input('rate_note'),
                'appointment_date' => $appointment[0]->start_at,
            ]);
        }

        return redirect()->back()->with('success', 'The rate has been created successfully');
    }


    public function send_email_from(Request $request)
    {
        $today = date('Y-m-d');

        $this->validate($request, [
            'phone_number' => 'required|numeric|regex:/(01)[0-9]{9}/|',
            'email' => 'nullable|email|max:30',
            'from_destination_id' => 'exists:destinations,id',
            'to_destination_id' => 'exists:destinations,id',
            'from_date' => 'date|date_format:Y-m-d|after_or_equal:today',
            'to_date' => 'date|after_or_equal:from_date',
            'subject' => 'required|max:100',
            'content' => 'required|max:255',
        ]);

        $form = Client_form::create([
            'code' => "CFO-" . generateRandomString(6),
            'phone_number' => $request->input('phone_number'),
            'email' => $request->input('email'),
            'from_destination_id' => $request->input('from_destination_id'),
            'to_destination_id' => $request->input('to_destination_id'),
            'from_date' => $request->input('from_date'),
            'to_date' => $request->input('to_date'),
            'subject' => $request->input('subject'),
            'content' => $request->input('content'),
        ]);

        return redirect()->back()->with('success', 'Your form has been sent successfully');
    }



    public function articles()
    {
        $articles = Article::paginate(9);

        return view('website/article/index', compact('articles'));
    }


    public function article_show(Request $request, $slug)
    {
        $article = Article::where('slug', $slug)->first();

        if (!$article) {
            abort(404);
        }

        $tags = $article->tags()->pluck('tag_id')->toArray();

        $related_articles = Article::whereHas('tags', function ($q) use ($tags) {
            $q->whereIn('tag_id', $tags);
        })
            ->get();

        return view('website/article/show', compact('article', 'related_articles'));
    }




    public function contact_us()
    {
        return view('website.homepage.contact_us');
    }

    public function about_us()
    {
        return view('website.homepage.about_us');
    }
}
