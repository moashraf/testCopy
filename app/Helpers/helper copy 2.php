<?php

// --------------------- func to bulid the calander ---------------------

//get $month, $year, $branch from POST method

use App\Models\Branch\Appointment;
use App\Models\Branch\Branch;
use App\Models\Branch\Oper_placecat;
use App\Models\Branch\Operation;
use App\Models\Prox_setting;
use Illuminate\Support\Facades\DB;

function build_calendar($month, $year, $specialty, $branch, $unit_id, $duration, $cleanup, $start, $end, $weekends)
{

    //----- to bulid date -----

    //geting the weeks days
    $daysOfWeek = array('M', 'T', 'W', 'T', 'F', 'S', 'S');

    //getting the first day of the month
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);

    //how many days does this month contain?
    $numberDays = date('t', $firstDayOfMonth);

    //getting more info about the month
    $dateComponents = getdate($firstDayOfMonth);

    //getting the month name
    $monthName = $dateComponents['month'];

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
    $calendar .= "<div class='bi bi-chevron-left amber-text' id='change_month' style='cursor: pointer;' data-month='" . $prev_month . "' data-year='" . $prev_year .
        "'></div>";

    $calendar .= "<a>$monthName $year</a>";

    $calendar .= "<div class='bi bi-chevron-right amber-text' id='change_month' style='cursor: pointer;' data-month='" . $next_month . "' data-year='" . $next_year .
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
        $today = $dateLoop == date('Y-m-d') ? "today_calander" : "";

        // --- to show the booked and N/A and alredy booked days --

        //select and show the days before today that can not be booked (N/A)
        if ($dateLoop < date("Y-m-d")) {
            $calendar .= "<td><div class='td_calander'><a class='disabled_link' style='padding-top: 6px;'>$currentDayRel</a></div>";
        }
        //to show the holidays that is disabled to appointment
        elseif (in_array($dayname, $holidays)) {
            $calendar .= "<td>
            <div class='td_calander $today'>    
                <a class='disabled_link' style='padding-top: 6px;'>$currentDayRel</a>
            </div>
            ";
        }
        //select and insert the available and aleaady booked days
        else {

            $checkSlot = checkSlot($dateLoop, $specialty, $branch, $unit_id); //to check how many slots have aleady booked
            $totalBookings = count($checkSlot);
            $timeslots = timeslots($duration, $cleanup, $start, $end); //timeslots funcation
            $count_timeslots = count($timeslots); //to count how many timeslots in total

            //aleardy booked day (closed)
            if ($totalBookings == $count_timeslots) {
                $calendar .= "<td>
                <div class='td_calander booked_calander' data-bs-toggle='tooltip' data-bs-placement='top' title='Fully Booked' style='padding-top: 6px;'>    
                    <a class='disabled_link text-light'>$currentDayRel</a>
                </div>
                ";
            } // available day
            else {
                $availableSlots = $count_timeslots - $totalBookings; //how many slots left to book
                $calendar .= "
                <td class='dropend' style='position: unset;'>
                <div class='td_calander click_day_calendar $today available_day_ajax_selected' id='available_day_ajax' style='cursor: pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='There are " . $availableSlots . " slot left'>  

                    <a class='show_slots' data-timeslots='" . $dateLoop . "' aria-expanded='false' style='padding-top: 6px;'>
                        <div style='height:100%; width:100%;' >
                        $currentDayRel
                        </div>
                    </a>";

                $calendar .= "<div class='text-center calendar_datapicker_timeslots px-2 py-2'></div>";

                $calendar .= "</div>"; //id='day_slots_ajax_click' will execute ajax timeslot and data-timeslots='' send the current date to it.
            }
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



//to show the wanted slots from the calendar 
function showSlots($duration, $cleanup, $start, $end, $datetoday, $specialty, $branch, $unit)
{

    $timeslots = timeslots($duration, $cleanup, $start, $end); //timeslots funcation

    $calendar = "";

    $calendar .= "<div class='text-start d-flex justify-content-between align-items-center mb-1'><h2>" . date('d M', strtotime($datetoday)) . "</h2><i class='fas fa-times fs-4 click_day_calendar-close clickable-item-pointer text-blue-300'></i></div>";

    $calendar .= "<div class='d-flex flex-wrap justify-content-center p-0'>";

    //for times
    foreach ($timeslots as $started => $ended) {
        //for avalable times
        $checkSlot_between = checkSlot_between($datetoday, $specialty, $branch, $unit, $started, $ended);

        //booked times
        if ($checkSlot_between > 0) {
            $calendar .= "<div class='calendar_booking_time_div'><a class='text-red'><del>" .  $started . "</del></a></div>";
        } else {
            $calendar .= "<div class='calendar_booking_time_div'><a class='available_day_ajax-selector clickable-item-pointer' data-day='" . $datetoday . "' data-start='" . $started . "' data-end='" . $ended . "'>" . $started . "</a></div>";
        }
    }

    $calendar .= "</div>";

    return $calendar;
}

// ----- to check how many slots have aleady booked -----
//it is used it inside the calander func

function checkSlot($date, $specialty, $branch, $unit_id)
{
    global $conn; //to make the $conn works inside the func

    $stmt_timeslot = Appointment::select(DB::raw('DATE_FORMAT(start_at,"%h:%i %p") as bookingStart'))
        ->whereDate('start_at', '=', $date)
        ->where('specialty_id', '=', $specialty)
        ->where('branch_id', '=', $branch)
        ->where('unit_id', '=', $unit_id)
        ->where('status', '!=', 6)
        ->pluck('bookingStart')
        ->toArray();

    return $stmt_timeslot;
}


function checkSlot_between($date, $specialty, $branch, $unit, $start, $end)
{
    global $conn; //to make the $conn works inside the func

    $start = date("H:i:s", strtotime($start));
    $end = date("H:i:s", strtotime($end));

    $start_date = $date . ' ' . $start;
    $end_date = $date . ' ' . $end;

    $stmt_timeslot = Appointment::select('id')
        ->where('start_at', '<=', $start_date)
        ->where('end_at', '>=', $end_date)
        ->where('specialty_id', '=', $specialty)
        ->where('branch_id', '=', $branch)
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



// --------------------- func to calander by week ---------------------

function weeklyCalendar($year, $week)
{

    $dt = new DateTime;

    $dt->setISODate($year, $week);

    $year = $dt->format('o');
    //the week year number
    $week = $dt->format('W');
    $month = $dt->format('F');
    $year = $dt->format('Y');

    $result = "";

    $result .= "<th class='text-center'>";
    $result .= "<div class='text-gray-mixed-300 clickable-item-pointer fs-5 btn-xs py-2' id='change_week' data-week='" . ($week - 1) . "' data-year='" . $year . "'><i class='fas fa-chevron-left shadow'></i></div>";
    $result .= "</th>";

    do {
        if ($dt->format('d M Y') === date('d M Y')) {
            $result .= "<th class='px-6'><div id='change_calendar_timeslots' class='calendar_weekly_today clickable-item-pointer py-2' data-year='" . date('Y') . "' data-month='" . date('m') . "' data-day='" . date('d') . "' ><p class='text-xs fw-lighter text-blue-300 mb-0'>" . $dt->format('D') . "</p><span class='fs-5'>" . $dt->format('d') . "<span></div></th>\n";
        } else {
            $result .= "<th><div id='change_calendar_timeslots' data-year='" . $dt->format('Y') . "' data-month='" . $dt->format('m') . "' data-day='" . $dt->format('d') . "' class='clickable-item-pointer text-center py-2 b-r-s-cont calendar_weekly_normal'><p class='text-xs fw-lighter mb-0'>" . $dt->format('D') . "</p><span class='fs-5'>" . $dt->format('d') . "<span></div></th>\n";
        }
        //to insert days till reach the next week
        $dt->modify('+1 day');
    } while (
        $week == $dt->format('W')
    );

    $result .= "<th class='text-center'>";
    $result .= "<div class='text-gray-mixed-300 clickable-item-pointer fs-5 btn-xs py-2' id='change_week' data-week='" . ($week + 1) . "' data-year='" . $year . "'><i class='fas fa-chevron-right shadow'></i></div>";
    $result .= "</th>";

    return $result;
}


// ------ calander by week END ------


//timeslots for showing books
function weeklyCalanderTimeslots($duration, $cleanup, $start, $end)
{
    $start = new DateTime($start);
    $end = new DateTime($end);
    $durationInterval = new DateInterval("PT" . $duration . "M");
    $cleanupInterval = new DateInterval("PT" . $cleanup . "M");
    $slots_start = array();
    $slots_end = array();

    for ($intStart = $start; $intStart < $end; $intStart->add($durationInterval)->add($cleanupInterval)) {

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

//proxima settings 
function prox_sett($option_name)
{

    $sett = Prox_setting::select('option_value')->where('option_name', $option_name)->first();

    return $sett->option_value;
}

// ---------------- appointments ----------------

function monthly_calendar($month, $year, $specialty, $branch, $unit)
{

    //----- to bulid date -----

    //geting the weeks days
    $daysOfWeek = array('M', 'T', 'W', 'T', 'F', 'S', 'S');

    //getting the first day of the month
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);

    //how many days does this month contain?
    $numberDays = date('t', $firstDayOfMonth);

    //getting more info about the month
    $dateComponents = getdate($firstDayOfMonth);

    //getting the month name
    $monthName = $dateComponents['month'];

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
    $calendar = "<div class='calander_date_monthly'>";

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
    $calendar .= "<div class='bi bi-chevron-left amber-text' id='change_month' style='cursor: pointer;' data-month='" . $prev_month . "' data-year='" . $prev_year .
        "'></div>";

    $calendar .= "<a>$monthName $year</a>";

    $calendar .= "<div class='bi bi-chevron-right amber-text' id='change_month' style='cursor: pointer;' data-month='" . $next_month . "' data-year='" . $next_year .
        "'></div>";

    $calendar .= "</div>";

    //creating HTML table
    $calendar .= "<table class='table table_booking_monthly'>";
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
            $calendar .= "<td><div class='td_calander_monthly td_calander_monthly_empty empty_calander'></td>";
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
        $holidays = array('asda'); //weekends

        $eventNum = 0;

        //to styling current day in the calander using ternary operator and give it specific style
        //(Condition) ? (Statement1) : (Statement2(else));
        $today = $dateLoop == date('Y-m-d') ? "today_calander" : "";

        // --- to show the booked and N/A and alredy booked days --

        $checkSlot = checkSlot_monthly($dateLoop, $specialty, $branch, $unit); //to check how many slots have aleady booked
        $totalBookings = $checkSlot->sum('total');


        //select and show the days before today that can not be booked (N/A)
        if ($dateLoop < date("Y-m-d")) {

            $calendar .= "<td>
            <div class='td_calander_monthly td_calander_monthly_befor_today position-relative'>
            <a class='full-width-height-link clickable-item-pointer monthly_to_timeline_calendar' data-timeslot=$dateLoop data-specialty=$specialty data-branch=$branch data-unit=$unit></a>
            <div class='td_calander_monthly_num'>$currentDayRel</div>";

            if ($totalBookings > 0) {
                $calendar .= "<h6 class='mb-2'><i class='bi bi-calendar4-week me-1'></i><span class='d-none d-md-inline'>" . __('basic.total') . "</span> $totalBookings</h6><div class='mt-2'>";

                foreach ($checkSlot as $item) {
                    if ($item->status == 0) {
                        $status = "not_accepted-border";
                        $msg = __('patientappo.not accepted');
                    } elseif ($item->status == 1) {
                        $status = "accepted-border";
                        $msg = __('patientappo.accepted');
                    } elseif ($item->status == 2) {
                        $status = "arrived-border";
                        $msg = __('patientappo.arrived');
                    } elseif ($item->status == 3) {
                        $status = "inprog-border";
                        $msg = __('patientappo.with doctor');
                    } elseif ($item->status == 4) {
                        $status = "done-border";
                        $msg = __('patientappo.done');
                    } elseif ($item->status == 5) {
                        $status = "notresp-border";
                        $msg = __('patientappo.not respond');
                    } elseif ($item->status == 6) {
                        $status = "cancel-border";
                        $msg = __('patientappo.canceled');
                    }

                    $calendar .= "<h6 class='$status my-0 ps-1 mb-1 text-start text-xs py-1' ><span class='d-none d-md-inline'>" . $msg . ": </span>" . $item->total . "<h6>";
                }
            } else {
                $calendar .= "<div class='calendar_info mt-5 mt-md-4 text-s'><i class='bi bi-calendar-x fs-5'></i><h6 class='d-none d-md-block'>" . __('basic.no bookings calendar') . "</h6></div>";
            }

            $calendar .= "</div></div>";
        }

        //to show the holidays that is disabled to appointment
        elseif (in_array($dayname, $holidays)) {
            $calendar .= "<td>
            <div class='td_calander_monthly td_calander_monthly_holidays $today'>    
                <a class='disabled_link td_calander_monthly_num'>$currentDayRel</a>
            </div>
            ";
        }

        //select and insert the available and aleaady booked days
        else {

            $calendar .= "<td>
            <div class='td_calander_monthly $today td_calander_monthly_empty position-relative'>
            <a class='full-width-height-link clickable-item-pointer monthly_to_timeline_calendar' data-timeslot=$dateLoop data-specialty=$specialty data-branch=$branch data-unit=$unit></a>
            <div class='td_calander_monthly_num'>$currentDayRel</div>";

            if ($totalBookings > 0) {
                $calendar .= "<h6 class='mb-2'><i class='bi bi-calendar4-week me-1'></i><span class='d-none d-md-inline'>" . __('basic.total') . ":</span> $totalBookings</h6><div class='mt-2'>";

                foreach ($checkSlot as $item) {
                    if ($item->status == 0) {
                        $status = "not_accepted-border";
                        $msg = __('patientappo.not accepted');
                    } elseif ($item->status == 1) {
                        $status = "accepted-border";
                        $msg = __('patientappo.accepted');
                    } elseif ($item->status == 2) {
                        $status = "arrived-border";
                        $msg = __('patientappo.arrived');
                    } elseif ($item->status == 3) {
                        $status = "inprog-border";
                        $msg = __('patientappo.with doctor');
                    } elseif ($item->status == 4) {
                        $status = "done-border";
                        $msg = __('patientappo.done');
                    } elseif ($item->status == 5) {
                        $status = "notresp-border";
                        $msg = __('patientappo.not respond');
                    } elseif ($item->status == 6) {
                        $status = "cancel-border";
                        $msg = __('patientappo.canceled');
                    }

                    $calendar .= "<h6 class='$status my-0 ps-1 mb-1 text-start text-xs py-1' ><span class='d-none d-md-inline'>" . $msg . ": </span>" . $item->total . "<h6>";
                }
            } else {
                $calendar .= "<div class='calendar_info mt-5 mt-md-4'><i class='bi bi-calendar-x fs-5'></i><h6 class='d-none d-md-block'>" . __('basic.no bookings calendar') . "</h6></div>";
            }


            $calendar .= "</div></div>";
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

function checkSlot_monthly($date, $specialty, $branch, $unit)
{
    global $conn; //to make the $conn works inside the func

    $stmt_timeslot = Appointment::select('status', DB::raw('count(*) as total'),)
        ->whereDate('start_at', '=', $date)
        ->groupBy('status')
        ->where('specialty_id', '=', $specialty)
        ->where('branch_id', '=', $branch);

    if ($unit === 'all') {
        $stmt_timeslot = $stmt_timeslot->where('unit_id', '!=', 0);
    } else {
        $stmt_timeslot = $stmt_timeslot->where('unit_id', $unit);
    }

    $stmt_timeslot = $stmt_timeslot->get();

    return $stmt_timeslot;
}


// -------------------------- operation --------------------------

// --------------------- func to bulid the calander for operation ---------------------

//get $month, $year, $branch from POST method

function build_calendar_operation($month, $year, $specialty, $oper_place_id, $duration, $cleanup, $start, $end, $weekends)
{

    //----- to bulid date -----

    //geting the weeks days
    $daysOfWeek = array('M', 'T', 'W', 'T', 'F', 'S', 'S');

    //getting the first day of the month
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);

    //how many days does this month contain?
    $numberDays = date('t', $firstDayOfMonth);

    //getting more info about the month
    $dateComponents = getdate($firstDayOfMonth);

    //getting the month name
    $monthName = $dateComponents['month'];

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
    $calendar .= "<div class='bi bi-chevron-left amber-text' id='change_month' style='cursor: pointer;' data-month='" . $prev_month . "' data-year='" . $prev_year .
        "'></div>";

    $calendar .= "<a>$monthName $year</a>";

    $calendar .= "<div class='bi bi-chevron-right amber-text' id='change_month' style='cursor: pointer;' data-month='" . $next_month . "' data-year='" . $next_year .
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
        $today = $dateLoop == date('Y-m-d') ? "today_calander" : "";

        // --- to show the booked and N/A and alredy booked days --

        //select and show the days before today that can not be booked (N/A)
        if ($dateLoop < date("Y-m-d")) {
            $calendar .= "<td><div class='td_calander'><a class='disabled_link' style='padding-top: 6px;'>$currentDayRel</a></div>";
        }
        //to show the holidays that is disabled to appointment
        elseif (in_array($dayname, $holidays)) {
            $calendar .= "<td>
            <div class='td_calander $today'>    
                <a class='disabled_link' style='padding-top: 6px;'>$currentDayRel</a>
            </div>
            ";
        }
        //select and insert the available and aleaady booked days
        else {

            $checkSlot = checkSlot_operation($dateLoop, $specialty, $oper_place_id); //to check how many slots have aleady booked
            $totalBookings = count($checkSlot);
            $timeslots = timeslots($duration, $cleanup, $start, $end); //timeslots funcation
            $count_timeslots = count($timeslots); //to count how many timeslots in total

            //aleardy booked day (closed)
            if ($totalBookings == $count_timeslots) {
                $calendar .= "<td>
                <div class='td_calander booked_calander' data-bs-toggle='tooltip' data-bs-placement='top' title='Fully Booked' style='padding-top: 6px;'>    
                    <a class='disabled_link text-light'>$currentDayRel</a>
                </div>
                ";
            } // available day
            else {
                $availableSlots = $count_timeslots - $totalBookings; //how many slots left to book
                $calendar .= "
                <td class='dropend' style='position: unset;'>
                <div class='td_calander click_day_calendar $today available_day_ajax_selected' id='available_day_ajax' style='cursor: pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='There are " . $availableSlots . " slot left'>  

                    <a class='show_slots' data-timeslots='" . $dateLoop . "' aria-expanded='false' style='padding-top: 6px;'>
                        <div style='height:100%; width:100%;' >
                        $currentDayRel
                        </div>
                    </a>";

                $calendar .= "<div class='text-center calendar_datapicker_timeslots px-2 py-2'></div>";

                $calendar .= "</div>"; //id='day_slots_ajax_click' will execute ajax timeslot and data-timeslots='' send the current date to it.
            }
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
function checkSlot_operation($date, $specialty, $oper_place_id)
{
    global $conn; //to make the $conn works inside the func

    $stmt_timeslot = Operation::select(DB::raw('DATE_FORMAT(start_at,"%h:%i %p") as bookingStart'))
        ->whereDate('start_at', '=', $date)
        ->where('specialty_id', '=', $specialty)
        ->where('oper_place_id', '=', $oper_place_id)
        ->where('status', '!=', 6)
        ->pluck('bookingStart')
        ->toArray();

    return $stmt_timeslot;
}

//to show the wanted slots from the calendar 
function showSlots_operation($duration, $cleanup, $start, $end, $datetoday, $specialty, $oper_place_id)
{

    $timeslots = timeslots($duration, $cleanup, $start, $end); //timeslots funcation

    $calendar = "";

    $calendar .= "<div class='text-start d-flex justify-content-between align-items-center mb-1'><h2>" . date('d M', strtotime($datetoday)) . "</h2><i class='fas fa-times fs-4 click_day_calendar-close clickable-item-pointer text-blue-300'></i></div>";

    $calendar .= "<div class='d-flex flex-wrap justify-content-center p-0'>";

    //for times
    foreach ($timeslots as $started => $ended) {
        //for avalable times
        $checkSlot_between = checkSlot_between_operation($datetoday, $specialty, $oper_place_id, $started, $ended);

        //booked times
        if ($checkSlot_between > 0) {
            $calendar .= "<div class='calendar_booking_time_div'><a class='text-red'><del>" .  $started . "</del></a></div>";
        } else {
            $calendar .= "<div class='calendar_booking_time_div'><a class='available_day_ajax-selector clickable-item-pointer' data-day='" . $datetoday . "' data-start='" . $started . "' data-end='" . $ended . "'>" . $started . "</a></div>";
        }
    }

    $calendar .= "</div>";

    return $calendar;
}

function checkSlot_between_operation($date, $specialty, $oper_place_id, $start, $end)
{
    global $conn; //to make the $conn works inside the func

    $start = date("H:i:s", strtotime($start));
    $end = date("H:i:s", strtotime($end));

    $start_date = $date . ' ' . $start;
    $end_date = $date . ' ' . $end;

    $stmt_timeslot = Operation::select('id')
        ->where('start_at', '<=', $start_date)
        ->where('end_at', '>=', $end_date)
        ->where('specialty_id', '=', $specialty)
        ->where('oper_place_id', '=', $oper_place_id)
        ->where('status', '!=', 6)
        ->count();

    return $stmt_timeslot;
}

//------------------ end of slots checking and calander funcs

function monthly_calendar_operation($month, $year, $specialty, $branch)
{

    //----- to bulid date -----

    //geting the weeks days
    $daysOfWeek = array('M', 'T', 'W', 'T', 'F', 'S', 'S');

    //getting the first day of the month
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);

    //how many days does this month contain?
    $numberDays = date('t', $firstDayOfMonth);

    //getting more info about the month
    $dateComponents = getdate($firstDayOfMonth);

    //getting the month name
    $monthName = $dateComponents['month'];

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
    $calendar = "<div class='calander_date_monthly'>";

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
    $calendar .= "<div class='bi bi-chevron-left amber-text' id='change_month' style='cursor: pointer;' data-month='" . $prev_month . "' data-year='" . $prev_year .
        "'></div>";

    $calendar .= "<a>$monthName $year</a>";

    $calendar .= "<div class='bi bi-chevron-right amber-text' id='change_month' style='cursor: pointer;' data-month='" . $next_month . "' data-year='" . $next_year .
        "'></div>";

    $calendar .= "</div>";

    //creating HTML table
    $calendar .= "<table class='table table_booking_monthly'>";
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
            $calendar .= "<td><div class='td_calander_monthly td_calander_monthly_empty empty_calander'></td>";
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
        $holidays = array('asda'); //weekends

        $eventNum = 0;

        //to styling current day in the calander using ternary operator and give it specific style
        //(Condition) ? (Statement1) : (Statement2(else));
        $today = $dateLoop == date('Y-m-d') ? "today_calander" : "";

        // --- to show the booked and N/A and alredy booked days --

        $checkSlot = checkSlot_monthly_operation($dateLoop, $specialty, $branch); //to check how many slots have aleady booked
        $totalBookings = $checkSlot->sum('total');


        //select and show the days before today that can not be booked (N/A)
        if ($dateLoop < date("Y-m-d")) {

            $calendar .= "<td>
            <div class='td_calander_monthly td_calander_monthly_befor_today position-relative'>
            <a class='full-width-height-link clickable-item-pointer monthly_to_timeline_calendar' data-timeslot=$dateLoop data-specialty=$specialty data-branch=$branch></a>
            <div class='td_calander_monthly_num'>$currentDayRel</div>";

            if ($totalBookings > 0) {
                $calendar .= "<h6 class='mb-2'><i class='bi bi-calendar4-week me-1'></i><span class='d-none d-md-inline'>" . __('basic.total') . "</span> $totalBookings</h6><div class='mt-2'>";

                foreach ($checkSlot as $item) {
                    if ($item->status == 0) {
                        $status = "not_accepted-border";
                        $msg = __('patientappo.not scheduled');
                    } elseif ($item->status == 1) {
                        $status = "accepted-border";
                        $msg = __('patientappo.scheduled');
                    } elseif ($item->status == 2) {
                        $status = "arrived-border";
                        $msg = __('patientappo.accepted');
                    } elseif ($item->status == 3) {
                        $status = "done-border";
                        $msg = __('patientappo.done');
                    } elseif ($item->status == 4) {
                        $status = "notresp-border";
                        $msg = __('patientappo.not respond');
                    } elseif ($item->status == 5) {
                        $status = "inprog-border";
                        $msg = __('patientappo.postponed');
                    } elseif ($item->status == 6) {
                        $status = "cancel-border";
                        $msg = __('patientappo.canceled');
                    }

                    $calendar .= "<h6 class='$status my-0 ps-1 mb-1 text-start text-xs py-1' ><span class='d-none d-md-inline'>" . $msg . ": </span>" . $item->total . "<h6>";
                }
            } else {
                $calendar .= "<div class='calendar_info mt-5 mt-md-4 text-s'><i class='bi bi-calendar-x fs-5'></i><h6 class='d-none d-md-block'>" . __('basic.no bookings calendar') . "</h6></div>";
            }

            $calendar .= "</div></div>";
        }

        //to show the holidays that is disabled to appointment
        elseif (in_array($dayname, $holidays)) {
            $calendar .= "<td>
            <div class='td_calander_monthly td_calander_monthly_holidays $today'>    
                <a class='disabled_link td_calander_monthly_num'>$currentDayRel</a>
            </div>
            ";
        }

        //select and insert the available and aleaady booked days
        else {

            $calendar .= "<td>
            <div class='td_calander_monthly $today td_calander_monthly_empty position-relative'>
            <a class='full-width-height-link clickable-item-pointer monthly_to_timeline_calendar' data-timeslot=$dateLoop data-specialty=$specialty data-branch=$branch></a>
            <div class='td_calander_monthly_num'>$currentDayRel</div>";

            if ($totalBookings > 0) {
                $calendar .= "<h6 class='mb-2'><i class='bi bi-calendar4-week me-1'></i><span class='d-none d-md-inline'>" . __('basic.total') . ":</span> $totalBookings</h6><div class='mt-2'>";

                foreach ($checkSlot as $item) {
                    if ($item->status == 0) {
                        $status = "not_accepted-border";
                        $msg = __('patientappo.not scheduled');
                    } elseif ($item->status == 1) {
                        $status = "accepted-border";
                        $msg = __('patientappo.scheduled');
                    } elseif ($item->status == 2) {
                        $status = "arrived-border";
                        $msg = __('patientappo.accepted');
                    } elseif ($item->status == 3) {
                        $status = "done-border";
                        $msg = __('patientappo.done');
                    } elseif ($item->status == 4) {
                        $status = "notresp-border";
                        $msg = __('patientappo.not respond');
                    } elseif ($item->status == 5) {
                        $status = "inprog-border";
                        $msg = __('patientappo.postponed');
                    } elseif ($item->status == 6) {
                        $status = "cancel-border";
                        $msg = __('patientappo.canceled');
                    }

                    $calendar .= "<h6 class='$status my-0 ps-1 mb-1 text-start text-xs py-1' ><span class='d-none d-md-inline'>" . $msg . ": </span>" . $item->total . "<h6>";
                }
            } else {
                $calendar .= "<div class='calendar_info mt-5 mt-md-4'><i class='bi bi-calendar-x fs-5'></i><h6 class='d-none d-md-block'>" . __('basic.no bookings calendar') . "</h6></div>";
            }


            $calendar .= "</div></div>";
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

function checkSlot_monthly_operation($date, $specialty, $branch)
{
    global $conn; //to make the $conn works inside the func

    $stmt_timeslot = Operation::select('status', DB::raw('count(*) as total'),)
        ->whereDate('start_at', '=', $date)
        ->groupBy('status');


    if ($branch !== 'all') {
        $stmt_timeslot = $stmt_timeslot->Where('branch_id', $branch);
    }

    $stmt_timeslot = $stmt_timeslot->get();

    return $stmt_timeslot;
}