<?php

namespace App\Console\Commands;

use App\Http\Services\smsGateways\Victorylink;
use App\Models\Branch\Booking;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SendAppoConfSmsSameDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SendAppoConfSmsSameDay';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send a sms to patients who has accepted appointment every day at 1pm';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $appointment = Booking::select('id', 'patient_id', 'branch_id', 'start_at')
            ->with(['patient' => function ($q) {
                $q->select('id', 'first_name', 'phone_number');
            }])
            ->with(['branch' => function ($q) {
                $q->select('id', 'address');
            }])
            ->whereDate('start_at', Carbon::today())
            ->whereIn('status', [1, 2, 3])
            ->groupBy('patient_id')
            ->get();

        foreach ($appointment as $item) {

            $name = $item->patient->first_name;
            $branch = $item->branch->address;

            $clinicname = prox_sett('companyname');

            $sms_mesg_cont = "اهلا $name نذكرك بموعدك الليلة في عيادات $clinicname";

            app(Victorylink::class)->sendSms($item->patient->phone_number, $sms_mesg_cont, 'ar');
        }
    }
}
