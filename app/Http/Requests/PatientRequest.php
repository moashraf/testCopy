<?php

namespace App\Http\Requests;

use App\Rules\CouponRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\RequiredIf;

class PatientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->search_patient_id != null && isset($this->search_patient_id)) {
            return [
                'search_patient_id' => ['required', 'exists:patients,id'],
                'oper_place_id' => ['sometimes', 'required', 'exists:oper_placecats,id'],
                'unit_id' => ['nullable', 'exists:units,id'],
                'coupon_id' => ['nullable', 'exists:coupons,id', new CouponRule($this->search_patient_id)],
            ];
        } else {
            return [
                'avatar' => ['image', 'mimes:jpeg,jpg,png', 'max:300'],
                'first_name' => ['required', 'max:30'],
                'second_name' => ['max:60'],
                'email' => ['nullable', 'email:rfc,dns', ($this->email === $this->old_email) ? '' : 'unique:managers,email', 'max:255'],
                'password' => ['sometimes', 'required', 'confirmed', 'max:255'],
                'newpassword' => ['confirmed', 'max:255'],
                'gendar' => ['nullable'],
                'birthday' => ['nullable', 'date', 'date_format:Y-m-d'],
                'country_id' => ['nullable', 'exists:countries,id'],
                'city_id' => ['nullable', 'exists:cities,id'],
                'region_id' => ['nullable', 'exists:regions,id'],
                'phone_number' => ['required', ($this->phone_number === $this->old_phone_number) ? '' : 'unique:managers,phone_number', 'max:30'],
                'sec_phone_number' => ['nullable', 'max:30'],
                'note' => ['nullable', 'max:255'],
                'from_recourse_id' => ['exists:from_recourses,id', 'numeric'],
                'appointment_note' => ['max:255'],
                'coupon_id' => ['nullable', 'exists:coupons,id', new CouponRule($this->search_patient_id)],
            ];
        }
    }

    public function messages()
    {
        return [
            'country_id.numeric' => 'You have to choose from the list',
            'city_id.numeric' => 'You have to choose from the list',
            'search_patient_id.required' => 'You have not chosen a traveler',
            'calander_date_day.required' => 'You have not chosen a date',
        ];
    }
}
