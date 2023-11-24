<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
        return [
            'avatar' => ['image', 'mimes:jpeg,jpg,png', 'max:700'],
            'first_name' => ['required', 'max:60'],
            'second_name' => ['required', 'max:60'],
            'email' => ['sometimes', 'required', 'email', ($this->email === $this->old_email) ? '' : 'unique:users,email', 'max:255'],
            'password' => ['sometimes', 'required', 'confirmed', 'max:255'],
            'newpassword' => ['confirmed', 'max:255'],
            'gendar' => ['required'],
            'birthday' => ['required', 'date', 'date_format:Y-m-d'],
            'country' => ['required', 'exists:countries,id'],
            'city' => ['required', 'exists:cities,id'],
            'phone_number' => ['sometimes', 'required', ($this->phone_number === $this->old_phone_number) ? '' : 'unique:users,phone_number', 'max:30'],
            'sec_phone_number' => ['max:30'],
            'branch' => ['sometimes', 'required'],
            'started_work' => ['required', 'date', 'date_format:Y-m-d'],
            'deactivate' => ['sometimes', 'required'],
            'note' => ['max:255'],
            'all_imgs.*' => 'nullable|image|mimes:jpeg,jpg,png|max:1000|',
        ];
    }

    public function messages()
    {
        return [
            'country.numeric' => 'You have to choose from the list',
            'city.numeric' => 'You have to choose from the list',
            'branch.numeric' => 'u did not write it',
        ];
    }
}
