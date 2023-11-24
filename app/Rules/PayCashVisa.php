<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PayCashVisa implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($cash, $visa, $final_price)
    {
        $this->cash = $cash;
        $this->visa = $visa;
        $this->final_price = $final_price;
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
        if($this->cash && $this->visa){

            $tota_pay_amount = $this->cash + $this->visa;

            if($tota_pay_amount > $this->final_price){
                return false;
            }else{
                return true;
            }

        }elseif($this->cash){

            if($this->cash > $this->final_price){
                return false;
            }else{
                return true;
            }

        }elseif($this->visa){

            if($this->visa > $this->final_price){
                return false;
            }else{
                return true;
            }

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
        return 'The amount is higher than the serivce final';
    }
}