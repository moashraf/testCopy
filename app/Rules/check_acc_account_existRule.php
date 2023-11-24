<?php

namespace App\Rules;

use App\Models\Invoice\Acc_account;
use App\Models\Invoice\Coupon;
use App\Models\Invoice\Debtor;
use App\Models\Invoice\Invoice;
use App\Models\Patient\Patient;
use Illuminate\Contracts\Validation\Rule;

class check_acc_account_existRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($patient_id, $type)
    {
        $this->customer_id = $patient_id;

        //custmer or supplier
        $this->type = $type;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if ($this->type === "traveler") {
            $fetch_customer = Manager::select('id', 'acc_account_id')->find($this->customer_id);
        } else {
            $fetch_customer = Debtor::select('id', 'acc_account_id')->find($this->customer_id);
        }

        if (empty($fetch_customer->acc_account_id)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Sorry! This user has no account in accounting chart';
    }
}
