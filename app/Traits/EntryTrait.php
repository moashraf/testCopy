<?php

namespace App\Traits;

use App\Models\Branch\Currency;
use App\Models\Invoice\Acc_account;
use App\Models\Invoice\Acc_cost_center_item;
use App\Models\Invoice\Acc_entry;
use App\Models\Invoice\Acc_entry_item;
use App\Models\Invoice\Financial_year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait EntryTrait
{
    /**
     * @param Request $request
     * @return $this|false|string
     */
    public function insertEntry(Request $request, $entry_type, $branch_id, $date, $amount, $currency_id, $acc_account_id_credit, $acc_account_id_debtor, $description,  $invoice_id = null,  $payment_id = null, $booking_id = null)
    {
        $new_serial_number_entry = serial_number('entry');

        //1- entry, 2-invoice, 3-payment, 4 booking
        if ($entry_type == 1) {
            $description = $description;
        } elseif ($entry_type  == 2) {
            $description = $description;
        } elseif ($entry_type == 3) {
            $description = $description;
        } elseif ($entry_type == 4) {
            $description = $description;
        }

        // current financial years
        $financial_year = Financial_year::where('status', 1)->first();
        $financial_year_id = $financial_year->id;

        //---------- currency exchange if is not the same as the system -------------
        $system_currency = prox_sett('currency');
        if ($system_currency != $currency_id) {
            $fetch_currency_rate = Currency::select('rate')->find($currency_id);
            $fetch_currency_rate = $fetch_currency_rate->rate;
            $amount_local = $amount * $fetch_currency_rate;
        } else {
            $fetch_currency_rate = null;
            $amount_local = $amount;
        }

        //record in entry
        $main_entry = Acc_entry::create([
            'new_id' => $new_serial_number_entry,
            'code' => "ACE" . generateRandomString(6),
            'financial_year_id' => $financial_year_id,
            'type' => $entry_type,
            'currency_id' => $currency_id,
            'currency_rate' => $fetch_currency_rate,
            'total_amount' => $amount,
            'total_amount_local' => $amount_local,
            'invoice_id' => $invoice_id,
            'payment_id' => $payment_id,
            'booking_id' => $booking_id,
            'date' => $date,
            'branch_id' => $branch_id,
            'worker_id' => Auth::user()->id,
            'description' => $description,
        ]);

        //----- credit gives (accounts expenes) ------
        $account_fetch_credit = Acc_account::select('id', 'name', 'origin', 'current_debit', 'current_credit', 'current_balance', 'current_credit_local', 'current_debit_local', 'current_balance_local')
            ->find($acc_account_id_credit);

        $acc_current_balance_credit = $account_fetch_credit->current_balance;

        $account_fetch_credit->increment('current_credit', $amount);
        $account_fetch_credit->increment('current_credit_local', $amount_local);

        //if the account is credit 
        if ($account_fetch_credit->origin == 0) {
            //more credit and the acc origin is credit, balance will be (+)
            $account_fetch_credit->increment('current_balance', $amount);
            $account_fetch_credit->increment('current_balance_local', $amount_local);
            $new_acc_balance_credit =   $acc_current_balance_credit + $amount;
        } else {
            //more debit and the acc origin is credit, balance will be (-)
            $account_fetch_credit->decrement('current_balance', $amount);
            $account_fetch_credit->decrement('current_balance_local', $amount_local);
            $new_acc_balance_credit =  $acc_current_balance_credit - $amount;
        }


        //---------- currency exchange if is not the same as the system ------------
        if ($system_currency != $currency_id) {
            $new_acc_balance_credit_local = $new_acc_balance_credit * $fetch_currency_rate;
        } else {
            $new_acc_balance_credit_local = $new_acc_balance_credit;
        }

        $account_fetch_credit->save();

        $entry_item_credit = Acc_entry_item::create([
            'financial_year_id' => $financial_year_id,
            'type' => 0,
            'acc_entry_id' => $main_entry->id,
            'acc_account_id' => $acc_account_id_credit,
            'credit' => $amount,
            'debit' => 0,
            'account_balance' => $new_acc_balance_credit,

            'credit_local' => $amount_local,
            'debit_local' => 0,
            'account_balance_local' => $new_acc_balance_credit_local,

            'description' => $description,
            'branch_id' => $branch_id,
            'currency_id' => $currency_id,
            'date' => $date,
        ]);


        //----- debit takes (accounts expenes) ------
        $account_fetch_debit = Acc_account::select('id', 'name', 'origin', 'current_debit', 'current_credit', 'current_balance')
            ->find($acc_account_id_debtor);

        $acc_current_balance_debit = $account_fetch_debit->current_balance;

        $account_fetch_debit->increment('current_debit', $amount);
        $account_fetch_debit->increment('current_debit_local', $amount_local);

        //if the account is credit
        if ($account_fetch_debit->origin == 0) {
            //more credit and the acc origin is credit, balance will be +
            $account_fetch_debit->decrement('current_balance', $amount);
            $account_fetch_debit->decrement('current_balance_local', $amount_local);
            $new_acc_balance_debit =  $acc_current_balance_debit - $amount;
        } else {
            //if the account is debit
            //more debit and the acc debit is credit, balance will be -
            $account_fetch_debit->increment('current_balance', $amount);
            $account_fetch_debit->increment('current_balance_local', $amount_local);
            $new_acc_balance_debit =   $acc_current_balance_debit + $amount;
        }


        //------ currency exchange if is not the same as the system -------
        if ($system_currency != $currency_id) {
            $new_acc_balance_debit_local = $new_acc_balance_debit * $fetch_currency_rate;
        } else {
            $new_acc_balance_debit_local = $new_acc_balance_debit;
        }


        $account_fetch_debit->save();

        $entry_item_debit = Acc_entry_item::create([
            'financial_year_id' => $financial_year_id,
            'type' => 1,
            'acc_entry_id' => $main_entry->id,
            'acc_account_id' => $acc_account_id_debtor,
            'credit' => 0,
            'debit' => $amount,
            'account_balance' => $new_acc_balance_debit,

            'credit_local' => 0,
            'debit_local' => $amount_local,
            'account_balance_local' => $new_acc_balance_debit_local,

            'description' => $description,
            'branch_id' => $branch_id,
            'currency_id' => $currency_id,
            'date' => $date,
        ]);


        return [
            "main_entry" => $main_entry->id,
            "main_serial" => $main_entry->new_id,
            "entry_item_credit" => $entry_item_credit->id,
            "entry_item_debit" => $entry_item_debit->od,
        ];

        //$request->file($fieldname)
    }


    public function deleteEntry($entry_id)
    {
        //record in entry
        $main_entry = Acc_entry::find($entry_id);

        foreach ($main_entry->items as $item) {

            $fetch_entry_item = Acc_entry_item::find($item->id);

            if ($fetch_entry_item->credit > 0) {
                $amount = $fetch_entry_item->credit;
                $amount_local = $fetch_entry_item->credit_local;
                $type = "current_credit";
                $type_local = "current_credit_local";
            } else {
                $amount = $fetch_entry_item->debit;
                $amount_local = $fetch_entry_item->debit_local;
                $type = "current_debit";
                $type_local = "current_debit_local";
            }

            //----- credit gives (accounts expenes) ------
            $account_fetch_credit = Acc_account::select('id', 'name', 'origin', 'current_debit', 'current_credit', 'current_balance')
                ->find($fetch_entry_item->acc_account_id);


            $account_fetch_credit->decrement($type, $amount);
            $account_fetch_credit->decrement($type_local, $amount_local);

            if ($fetch_entry_item->credit > 0) {
                //if the account is credit 
                if ($account_fetch_credit->origin == 0) {
                    //more credit and the acc origin is credit, balance will be (+)
                    $account_fetch_credit->decrement('current_balance', $amount);
                    $account_fetch_credit->decrement('current_balance_local', $amount_local);
                } else {
                    //more debit and the acc origin is credit, balance will be (-)
                    $account_fetch_credit->increment('current_balance', $amount);
                    $account_fetch_credit->increment('current_balance_local', $amount_local);
                }
            } else {
                //if the account is credit 
                if ($account_fetch_credit->origin == 0) {
                    //more credit and the acc origin is credit, balance will be (+)
                    $account_fetch_credit->increment('current_balance', $amount);
                    $account_fetch_credit->increment('current_balance_local', $amount_local);
                } else {
                    //more debit and the acc origin is credit, balance will be (-)
                    $account_fetch_credit->decrement('current_balance', $amount);
                    $account_fetch_credit->decrement('current_balance_local', $amount_local);
                }
            }

            $account_fetch_credit->save();

            $fetch_entry_item->delete();
        }

        $main_entry->delete();

        return [
            "status" => true,
        ];
    }



    public function insertMainEntry(Request $request, $entry_type, $branch_id, $date, $amount, $currency_id, $description,  $invoice_id = null,  $payment_id = null, $booking_id = null)
    {

        $new_serial_number_entry = serial_number('entry');

        //1- entry, 2-invoice, 3-payment, 4 booking
        if ($entry_type == 1) {
            $description = $description;
        } elseif ($entry_type  == 2) {
            $description = "Invoice sales NO " . $invoice_id . " " . $request->input('note');
        } elseif ($entry_type == 3) {
            $description = "Payment NO #" . $payment_id . $description;
        } elseif ($entry_type == 4) {
            $description = "Booking NO #" . $booking_id . $description;
        }

        // current financial years
        $financial_year = Financial_year::where('status', 1)->first();
        $financial_year_id = $financial_year->id;

        //---------- currency exchange if is not the same as the system -------------
        $system_currency = prox_sett('currency');
        if ($system_currency != $currency_id) {
            $fetch_currency_rate = Currency::select('rate')->find($currency_id);
            $fetch_currency_rate = $fetch_currency_rate->rate;
            $amount_local = $amount * $fetch_currency_rate;
        } else {
            $fetch_currency_rate = null;
            $amount_local = $amount;
        }

        //record in entry
        $main_entry = Acc_entry::create([
            'new_id' => $new_serial_number_entry,
            'code' => "ACE" . generateRandomString(6),
            'financial_year_id' => $financial_year_id,
            'type' => $entry_type,
            'currency_id' => $currency_id,
            'currency_rate' => $fetch_currency_rate,
            'total_amount' => $amount,
            'total_amount_local' => $amount_local,
            'invoice_id' => $invoice_id,
            'payment_id' => $payment_id,
            'booking_id' => $booking_id,
            'date' => $date,
            'branch_id' => $branch_id,
            'worker_id' => Auth::user()->id,
            'description' => $description,
        ]);

        return [
            "main_entry" => $main_entry->id,
            "main_serial" => $main_entry->new_id,
        ];

        //$request->file($fieldname)
    }


    public function insertMainItemEntry(Request $request, $entry_type, $branch_id, $date, $type, $amount, $currency_id, $main_entry_id, $acc_account_id, $description,  $invoice_id = null,  $payment_id = null, $booking_id = null)
    {

        //--------- basic ----------
        $new_serial_number_entry = serial_number('entry');

        //1- entry, 2-invoice, 3-payment, 4 booking
        if ($entry_type == 1) {
            $description = $description;
        } elseif ($entry_type  == 2) {
            $description = "Invoice sales NO " . $invoice_id . " " . $request->input('note');
        } elseif ($entry_type == 3) {
            $description = "Payment NO #" . $payment_id . $description;
        } elseif ($entry_type == 4) {
            $description = "Booking NO #" . $booking_id . $description;
        }

        // current financial years
        $financial_year = Financial_year::where('status', 1)->first();
        $financial_year_id = $financial_year->id;

        //---------- currency exchange if is not the same as the system -------------
        $system_currency = prox_sett('currency');
        if ($system_currency != $currency_id) {
            $fetch_currency_rate = Currency::select('rate')->find($currency_id);
            $fetch_currency_rate = $fetch_currency_rate->rate;
            $amount_local = $amount * $fetch_currency_rate;
        } else {
            $fetch_currency_rate = null;
            $amount_local = $amount;
        }

        // -------- change balance ---------
        $account_fetch = Acc_account::select('id', 'name', 'origin', 'current_debit', 'current_credit', 'current_balance', 'current_credit_local', 'current_debit_local', 'current_credit_local')
            ->find($acc_account_id);

        $acc_current_balance = $account_fetch->current_balance;
        $acc_current_balance_local = $account_fetch->current_balance_local;

        //to know if it is credit or debit (0- credit, 1-debit)
        //credit
        if ($type == 0) {
            //change the account balance
            $account_fetch->increment('current_credit', $amount);
            $account_fetch->increment('current_credit_local', $amount_local);

            $credit_item = $amount;
            $debit_item = 0;
            $credit_item_local = $amount_local;
            $debit_item_local = 0;
        }
        //debit
        else {
            //change the account balance
            $account_fetch->increment('current_debit', $amount);
            $account_fetch->increment('current_debit_local', $amount_local);

            $credit_item = 0;
            $debit_item = $amount;
            $credit_item_local = 0;
            $debit_item_local = $amount_local;
        }

        //if it is credit
        if ($account_fetch->origin == 0) {
            if ($credit_item > 0) {
                //more credit and the acc origin is credit, balance will be +
                $account_fetch->increment('current_balance', $credit_item);
                $account_fetch->increment('current_balance_local', $credit_item_local);
                $new_acc_balance =  $credit_item + $acc_current_balance;
                $new_acc_balance_local =  $credit_item_local + $acc_current_balance_local;
            } else {
                //more debit and the acc origin is credit, balance will be -
                $account_fetch->decrement('current_balance', $debit_item);
                $account_fetch->decrement('current_balance_local', $debit_item_local);
                $new_acc_balance =  $acc_current_balance - $debit_item;
                $new_acc_balance_local =  $acc_current_balance_local - $debit_item_local;
            }
        } else {
            if ($debit_item > 0) {
                //more debit and the acc origin is debit, balance will be +
                $account_fetch->increment('current_balance', $debit_item);
                $account_fetch->increment('current_balance_local', $debit_item_local);

                $new_acc_balance =  $debit_item + $acc_current_balance;
                $new_acc_balance_local =  $debit_item_local + $acc_current_balance_local;
            } else {
                //more credit and the acc origin is debit, balance will be -
                $account_fetch->decrement('current_balance', $credit_item);
                $account_fetch->decrement('current_balance_local', $credit_item_local);

                $new_acc_balance =  $acc_current_balance - $credit_item;
                $new_acc_balance_local =  $acc_current_balance_local - $credit_item_local;
            }
        }

        $account_fetch->save();

        //----- entry item ------

        $entry_item = Acc_entry_item::create([
            'financial_year_id' => $financial_year_id,
            'type' => $type,
            'acc_entry_id' => $main_entry_id,
            'acc_account_id' => $acc_account_id,
            'credit' => $credit_item,
            'debit' => $debit_item,
            'account_balance' => $new_acc_balance,
            'credit_local' => $credit_item_local,
            'debit_local' => $debit_item_local,
            'account_balance_local' => $new_acc_balance_local,
            'description' => $description,
            'date' => $date,
            'branch_id' => $branch_id,
            'currency_id' => $currency_id,
        ]);


        return [
            "entry_item_id" => $entry_item->id,
            "credit_amount" => $credit_item,
            "debit_amount" => $debit_item,
            "credit_amount_local" => $credit_item_local,
            "debit_amount_local" => $debit_item_local,
        ];

        //$request->file($fieldname)
    }


    public function insertCostCenter(Request $request, $entry_type, $branch_id, $acc_account_id, $cost_center_id, $acc_entry_id, $date, $type, $amount, $amount_local, $currency_id, $fetch_currency_rate, $percentage, $description,  $invoice_id = null,  $payment_id = null, $booking_id = null)
    {


        // current financial years
        $financial_year = Financial_year::where('status', 1)->first();
        $financial_year_id = $financial_year->id;

        //--------- basic ----------
        $new_serial_number_entry = serial_number('cost_center');

        //1- entry, 2-invoice, 3-payment, 4 booking
        if ($entry_type == 1) {
            $description = $description;
        } elseif ($entry_type  == 2) {
            $description = "Invoice sales NO " . $invoice_id . " " . $request->input('note');
        } elseif ($entry_type == 3) {
            $description = "Payment NO #" . $payment_id . $description;
        } elseif ($entry_type == 4) {
            $description = "Booking NO #" . $booking_id . $description;
        }

        $cost_center = Acc_cost_center_item::create([
            'new_id' => $new_serial_number_entry,
            'code' => "CEN" . generateRandomString(6),
            'financial_year_id' => $financial_year_id,
            'type' => $entry_type,
            'acc_account_id' => $acc_account_id,
            'acc_cost_center_id' => $acc_account_id,
            'currency_id' => $currency_id,
            'currency_rate' => $fetch_currency_rate,
            'percentage' => $percentage,
            'total_amount' => $amount,
            'total_amount_local' => $amount_local,
            'invoice_id' => $invoice_id,
            'payment_id' => $payment_id,
            'booking_id' => $booking_id,
            'date' => $date,
            'branch_id' => $branch_id,
            'worker_id' => Auth::user()->id,
            'description' => $description,
        ]);

        return [
            "id" => $cost_center->id,
        ];
        //$request->file($fieldname)
    }
}
