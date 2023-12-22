<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\Basic_mail;
use App\Models\Branch\Appointment;
use App\Models\Branch\Branch;
use App\Models\Branch\Unit_booking;
use App\Models\Invoice\Invoice;
use App\Models\Invoice\Invoice_item;
use App\Models\location\Country;
use App\Models\Patient\From_recourse;
use App\Models\Patient\Patient;
use App\Models\School\Manager;
use App\Models\School\School;
use App\Models\School\Student\Student;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::id();

        $user_note = User::select('note')->find($id);

        $students_total = Student::select('id')->count();
        $teachers_total = Manager::select('id')->where('type', 3)->count();
        $schools_total = School::select('id')->count();

        $year = date('Y');
        $month = date('m');

        $patient_total = Manager::select('id')
            ->where('type', 1)
            ->count();

        $last_patient = Manager::select('id', 'avatar', 'first_name', 'second_name')
            ->orderBy('id', 'DESC')
            ->where('type', 1)
            ->limit(5)
            ->get();


        $patient = Manager::select(
            DB::raw('count(id) as counts'),
            DB::raw("DATE_FORMAT(created_at,'%m') as monthKey")
        )
            ->whereYear('created_at', date('Y'))
            ->where('type', 1)
            ->groupBy('monthKey')
            ->orderBy('created_at', 'ASC')
            ->get();

        $patient_date = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        foreach ($patient as $order) {
            $patient_date[$order->monthKey - 1] = $order->counts;
        }

        $patient_total = Manager::whereYear('created_at', date('Y'))
            ->where('type', 1)
            ->count();

        return view('dashboard', compact('user_note', 'students_total', 'teachers_total', 'schools_total', 'patient_total', 'last_patient', 'patient', 'patient_date', 'patient_total'));
    }
}
