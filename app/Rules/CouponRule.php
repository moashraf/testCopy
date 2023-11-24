<?php

namespace App\Rules;

use App\Models\Invoice\Coupon;
use App\Models\Invoice\Invoice;
use Illuminate\Contracts\Validation\Rule;

class CouponRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($patient_id)
    {
        $this->patient_id = $patient_id;
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

        $coupon = Coupon::where('id', $value)->first();

        //if the coupon exists
        if(!empty($coupon)){
            $coupon_id = $coupon->id;
        }else{
            return true;
        }

        $used_coupon = Invoice::where('coupon_id', $coupon_id)->where('receivable_id', $this->patient_id)->where('receivable_type', 'App\Models\Patient\Patient')->first();

        if(!empty($used_coupon)) {
            return false;
        }else{
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
        return 'Sorry! You have used this coupon before';
    }
}