<?php

// --------------------- func to bulid the calander ---------------------

//get $month, $year, $branch from POST method

use App\Models\Branch\Airline_ticket;
use App\Models\Branch\Appointment;
use App\Models\Branch\Booking;
use App\Models\Branch\Branch;
use App\Models\Branch\Oper_placecat;
use App\Models\Branch\Operation;
use App\Models\Branch\Package_booking;
use App\Models\Branch\Transp_ticket;
use App\Models\Branch\Transp_ticket_seat;
use App\Models\Branch\Trip_booking;
use App\Models\Branch\Unit_booking;
use App\Models\Branch\Unit_booking_room;
use App\Models\Branch\Unit_offer_price;
use App\Models\Branch\Unit_offer_price_exception;
use App\Models\Branch\Unit_offer_room_price;
use App\Models\Branch\Unit_offer_room_price_exception;
use App\Models\Branch\Unit_offer_room_price_market;
use App\Models\Branch\Visa_booking;
use App\Models\Invoice\Acc_account;
use App\Models\Invoice\Acc_cost_center_item;
use App\Models\Invoice\Acc_entry;
use App\Models\Invoice\Acc_treasury;
use App\Models\Invoice\Debtor;
use App\Models\Invoice\Invoice;
use App\Models\Invoice\Payment;
use App\Models\Invoice\quotation\Quotation;
use App\Models\Invoice\Work_order;
use App\Models\Patient\Patient;
use App\Models\Patient\Wishlist;
use App\Models\Prox_setting;
use App\Models\School\Manager;
use App\Models\School\School;
use App\Models\School\Student\School_event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

function build_calendar($month, $year, $school_id, $weekends)
{

    //----- to bulid date -----

    //geting the weeks days
    $daysOfWeek = array('الاثنين', 'الثلاثاء', 'الاربعاء', 'الثلاثاء', 'الجمعة', 'السبت', 'الاحد');

    //getting the first day of the month
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);

    //how many days does this month contain?
    $numberDays = date('t', $firstDayOfMonth);

    //getting more info about the month
    $dateComponents = getdate($firstDayOfMonth);

    //getting the month name
    $monthName = $dateComponents['month'];


    // change months to arabic
    $months = array("January" => "يناير", "February" => "فبراير", "March" => "مارس", "April" => "أبريل", "May" => "مايو", "Jun" => "يونيو", "July" => "يوليو", "August" => "أغسطس", "September" => "سبتمبر", "October" => "أكتوبر", "November" => "نوفمبر", "December" => "ديسمبر");

    $en_month = $monthName;
    foreach ($months as $en => $ar) {
        if ($en == $en_month) {
            $ar_month = $ar;
        }
    }

    //getting the index value 0-6 of the first day of this month (0=Sunday, 1=Monday,...)
    $dayOfWeek = $dateComponents['wday'];

    //to make sunday index the last day of week
    if ($dayOfWeek == 0) {
        $dayOfWeek = 6;
    } else {
        $dayOfWeek = $dayOfWeek - 1;
    }

    //getting the curet date
    $dateToday = date("Y-m-d");

    //current year and nev for next and prev month and year button
    $calendar = "<div class='calander_date position-relative'>";

    $calendar .= "<div class='date_navigator d-flex justify-content-between align-items-center'>";

    $prev_month = date('m', mktime(0, 0, 0, $month - 1, 1, $year));
    $prev_year = date('Y', mktime(0, 0, 0, $month, 1, $year));
    $next_month = date('m', mktime(0, 0, 0, $month + 1, 1, $year));
    $next_year = date('Y', mktime(0, 0, 0, $month + 1, 1, $year));
    /*     
    $calendar .= "<a class='bi bi-chevron-left amber-text' href='?month=" . $prev_month . "&year=" . $prev_year .
        "'></a>";

    $calendar .= "<a>$monthName $year</a>";

    $calendar .= "<a class='bi bi-chevron-right' href='?month=" . $next_month . "&year=" . $next_year .
        "'></a>";
    */
    $calendar .= "<div class='bi bi-chevron-left amber-text clickable-item-pointer' id='change_month' data-month='" . $prev_month . "' data-year='" . $prev_year .
        "'></div>";

    $calendar .= "<a>$ar_month $year</a>";

    $calendar .= "<div class='bi bi-chevron-right amber-text clickable-item-pointer' id='change_month' data-month='" . $next_month . "' data-year='" . $next_year .
        "'></div>";

    $calendar .= "</div>";

    //creating HTML table
    $calendar .= "<table class='table table_booking'>";
    // Create the calendar headers (weeks days)
    $calendar .= "<tr>";
    foreach ($daysOfWeek as $day) {
        $calendar .= "<th class='header'>$day</th>";
    };

    // Create the rest of the calendar
    $calendar .= "</tr><tr>";

    // Initiate the day counter, starting with the 1st and it's increasing through while loop. 
    $currentDay = 1;

    // The variable $dayOfWeek (0-6) is used to ensure that the calendar 
    // displays consists of exactly 7 columns.

    //to put empty columns before the first day if it does not start in sunday (0 index)
    if ($dayOfWeek > 0) {
        for ($k = 0; $k < $dayOfWeek; $k++) {
            $calendar .= "<td><div class='td_calander empty_calander'></td>";
        }
    }

    //to add 0 on the left of the month number if it's less than 2 numbers and
    //make it 2 numbers e.g. 01 instaed of 1
    $month = str_pad($month, 2, "0", STR_PAD_LEFT);

    //start a loop unitl it reached the final day of month ($numberDays) (to create days in calander).
    while ($currentDay <= $numberDays) {

        //Seventh column (Saturday)(6) reached. Start a new row. 
        if ($dayOfWeek == 7) {
            //start the index from 0 again when it gets to 7 days to have a new row by insert (</tr>)
            $dayOfWeek = 0;
            $calendar .= "</tr><tr>";
        }

        //add 0 to the current day that has one character to be eg 01 to match the satdnerd 
        //of date()
        $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
        $dateLoop = "$year-$month-$currentDayRel"; //--- the current day, month,year of the loop ---//

        //get the day name with lowercase letters
        $dayname = strtolower(date('l', strtotime($dateLoop)));
        //weekends from the database (user)
        $holidays = $weekends; //weekends

        $eventNum = 0;

        //to styling current day in the calander using ternary operator and give it specific style
        //(Condition) ? (Statement1) : (Statement2(else));

        $check_event = checkEvents($dateLoop);

        $today = $dateLoop == date('Y-m-d') ? "today_calander" : "";
        $today_icon = $dateLoop == date('Y-m-d') ? '<i class="fas fa-circle main-color text-xxxxs d-block"></i>' : '';

        $today_event_border = $check_event['name'] !== null ? 'calendar_today_event' : '';
        $today_event_name = $check_event['name'] !== null ? '<h6 class="text-xxxxs">' .  $check_event['name'] . '<h6>' : '';

        // --- to show the booked and N/A and alredy booked days --

        //select and show the days before today that can not be booked (N/A)
        if ($dateLoop < date("Y-m-d")) {
            $calendar .= "<td><div class='td_calander'><a class='disabled_link'>$currentDayRel</a></div>";
        }

        //to show the holidays that is disabled to appointment
        elseif (in_array($dayname, $holidays)) {
            $calendar .= "<td>
            <div class='td_calander $today'>    
                <a class='disabled_link'>$currentDayRel</a>
            </div>
            ";
        }
        //select and insert the available and already booked days
        else {
            $calendar .= " 
                <td class='dropend' style='position: unset;'>
                <div class='td_calander click_day_calendar $today $today_event_border available_day_ajax_selected' id='available_day_ajax' data-bs-toggle='tooltip' data-bs-placement='top'>  

                    <a class='available_day_ajax-selector' data-timeslots='" . $dateLoop . "' aria-expanded='false'>
                        <div style='height:100%; width:100%;' >
                        $currentDayRel
                        $today_icon
                        $today_event_name
                        </div>
                    </a>";

            $calendar .= "<div class='text-center calendar_datapicker_timeslots px-2 py-2'></div>";

            $calendar .= "</div>";
        }

        $calendar .= "</td>";

        //Increment counters 
        $currentDay++;
        $dayOfWeek++;
    } //end of while loop

    //Complete the row of the days left in month, (if necessary) 
    if ($dayOfWeek != 7) {
        $remainingDays = 7 - $dayOfWeek;
        for ($l = 0; $l < $remainingDays; $l++) {
            $calendar .= "<td><div class='td_calander empty_calander'></td>";
        }
    }

    $calendar .= "</tr>";
    $calendar .= "</table>";
    $calendar .= "</div>"; //the end of calander date 

    return $calendar;
    //end of build_calendar funcation

} //------------------ end of calander date func



// ----- to check how many slots have aleady booked -----
//it is used it inside the calander func

function checkEvents($date, $school_id = null)
{
    global $conn; //to make the $conn works inside the func

    $array_day_name = strtolower(date('l', strtotime($date)));

    $event = School_event::select('id', 'name')
        ->whereDate('event_date', $date)
        ->first();


    if ($event) {
        return [
            "status" => true,
            "name" => $event->name,
        ];
    } else {
        return [
            "status" => false,
            "name" => null,
        ];
    }
}


function checkSlot_between($date, $specialty, $branch, $unit, $start, $end)
{
    global $conn; //to make the $conn works inside the func

    $start = date("H:i:s", strtotime($start));
    $end = date("H:i:s", strtotime($end));

    $start_date = $date . ' ' . $start;
    $end_date = $date . ' ' . $end;

    $stmt_timeslot = Unit_booking::select('id')
        ->where('start_at', '<=', $start_date)
        ->where('end_at', '>=', $end_date)
        ->where('unit_id', '=', $unit)
        ->where('status', '!=', 6)
        ->count();

    return $stmt_timeslot;
}
//------------------ end of slots checking and calander funcs



// --------------------- func to create the time slots in create calendar ---------------------

// -- start time slots func --
function timeslots($duration, $cleanup, $start, $end)
{
    $start = new DateTime($start);
    $end = new DateTime($end);
    $durationInterval = new DateInterval("PT" . $duration . "M"); //add 10 min that came from $duration
    $cleanupInterval = new DateInterval("PT" . $cleanup . "M");
    $slots_start = array();
    $slots_end = array();

    // to do loop to add 45 mintutes and 15 minutes to $start date using dateTime add() method with DateInterval()
    for ($intStart = $start; $intStart < $end; $intStart->add($durationInterval)->add($cleanupInterval)) {

        //add duration time to print it in the text (eg. 10:00 to 10:45) and break it when it gets to the end of time
        $endPeriod = clone $intStart;
        $endPeriod->add($durationInterval);
        if ($endPeriod > $end) {
            break;
        }

        $slots_start[] = $intStart->format("h:i A");
        $slots_end[] = $endPeriod->format("h:i A");
    }

    return $slots = array_combine($slots_start, $slots_end);
}

// ------ Timeslots END ------



//proxima settings 
function prox_sett($option_name)
{

    $sett = Prox_setting::select('option_value')->where('option_name', $option_name)->first();

    return $sett->option_value;
}


// -------------------------- operation --------------------------


function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString;
}

function serial_number($type, $branch_id = null)
{
    if ($type === "school") {
        //create the new serial code 000001
        $fetch_code_id = School::select('id', 'new_id')
            ->latest()->take(1)->first();
        if ($fetch_code_id) {
            // Get the last order id
            $last_code_id = $fetch_code_id->new_id; //999999 //000002
        } else {
            $last_code_id = "SCH-000000";
        }
        $code = "SCH-";
    } elseif ($type === "invoice_income") {
        //create the new serial code 000001
        $fetch_code_id = Invoice::select('id', 'new_id')
            ->where('type', 0)
            ->latest()->take(1)->first();
        if ($fetch_code_id) {
            // Get the last order id
            $last_code_id = $fetch_code_id->new_id; //999999 //000002
        } else {
            $last_code_id = "INI-000000";
        }
        $code = "INI-";
    } elseif ($type === "invoice_expenses") {
        //create the new serial code 000001
        $fetch_code_id = Invoice::select('id', 'new_id')
            ->where('type', 1)
            ->latest()->take(1)->first();
        if ($fetch_code_id) {
            // Get the last order id
            $last_code_id = $fetch_code_id->new_id; //999999 //000002
        } else {
            $last_code_id = "INE-000000";
        }
        $code = "INE-";
    } elseif ($type === "payment_income") {
        //create the new serial code 000001
        $fetch_code_id = Payment::select('id', 'new_id')
            ->where('type', 0)
            ->latest()->take(1)->first();
        if ($fetch_code_id) {
            // Get the last order id
            $last_code_id = $fetch_code_id->new_id; //999999 //000002
        } else {
            $last_code_id = "PYI-000000";
        }
        $code = "PYI-";
    } elseif ($type === "payment_expenses") {
        //create the new serial code 000001
        $fetch_code_id = Payment::select('id', 'new_id')
            ->where('type', 1)
            ->latest()->take(1)->first();
        if ($fetch_code_id) {
            // Get the last order id
            $last_code_id = $fetch_code_id->new_id; //999999 //000002
        } else {
            $last_code_id = "PYE-000000";
        }
        $code = "PYE-";
    } elseif ($type === "managers") {

        $code = "MAG-";

        //create the new serial code 000001
        $fetch_code_id = Manager::select('id', 'new_id')
            ->latest()->take(1)->first();

        if ($fetch_code_id) {
            // Get the last order id
            $last_code_id = $fetch_code_id->new_id; //999999 //000002
        } else {
            $last_code_id = $code . "000000";
        }
    } elseif ($type === "work_order") {

        $code = "WOD-";
        //create the new serial code 000001
        $fetch_code_id = Work_order::select('id', 'new_id')
            ->latest()->take(1)->first();
        if ($fetch_code_id) {
            // Get the last order id
            $last_code_id = $fetch_code_id->new_id; //999999 //000002
        } else {
            $last_code_id = $code . "000000";
        }
    } elseif ($type === "booking") {

        //fetch code
        if ($branch_id) {
            $branch = Branch::select('id', 'code')->find($branch_id);
            $code = "B" . $branch->code . "-";
        } else {
            $code = "BOOK-";
        }

        //create the new serial code 000001
        $fetch_code_id = Booking::select('id', 'new_id')
            ->where('branch_id', $branch_id)
            ->latest()->take(1)->first();

        if ($fetch_code_id) {
            // Get the last order id
            $last_code_id = $fetch_code_id->new_id; //999999 //000002
        } else {
            //create the new serial code 000001
            $fetch_code_id = Booking::select('id', 'new_id')
                ->where('branch_id', $branch_id)
                ->latest()->take(1)->first();

            $last_code_id = $code . "000000";
        }
    } elseif ($type === "cost_center") {
        $code = "CEN-";
        //create the new serial code 000001
        $fetch_code_id = Acc_cost_center_item::select('id', 'new_id')
            ->latest()->take(1)->first();
        if ($fetch_code_id) {
            // Get the last order id
            $last_code_id = $fetch_code_id->new_id; //999999 //000002
        } else {
            $last_code_id = $code . "000000";
        }
    }

    // Get last 6 digits of last order id without ENT-
    $last_code_id = substr($last_code_id, -6);

    // Make a new order id with appending last increment + 1
    $new_code_id = $code . str_pad(intval($last_code_id) + 1, strlen($last_code_id), '0', STR_PAD_LEFT);

    return $new_code_id;
}
