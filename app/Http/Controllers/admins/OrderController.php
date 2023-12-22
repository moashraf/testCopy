<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\location\CountryWantBook;
use Illuminate\Support\Facades\Auth;
use App\Models\location\Country;
use App\Models\Branch\Order;

class OrderController extends Controller
{
    //

    public function visa_service()
    {
        $country = Country::all();
        // $country_you_want_book = CountryWantBook::all();


        return view('website.client.visa_service', compact('country'));
    }

    public function order(Request $request)
    {

        // return $request;
        $this->validate(
            $request,
            [
                'image_order' => 'image|mimes:jpeg,jpg,png|max:700|dimensions:max_width:300,max_height:200',
                'name' => 'required',
                'birth_date' => 'required',
                'email' => 'required',
                'phone' => 'required|max:50|min:10',
                'country_want_book' => 'required',
                'country_id' => 'required',
                'about' => 'required',

            ]
        );


        if ($request->hasFile('image_order')) {
            $file_extension = request()->image_order->getClientOriginalExtension();
            $file_name = $request->input('name') . 'image_order' . time() . '.' . $file_extension;
            $path = 'img/products';
            $request->image_order->move($path, $file_name);
        }


        $order = Order::create([

            // 'unit_image' => $file_name,
            'image_order' => $file_name,
            'name' => $request->input('name'),
            'birth_date' => $request->input('birth_date'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'about' => $request->input('about'),
            'country_id' => $request->input('country_id'),
            'country_want_book' => $request->input('country_want_book'),
        ]);



        return redirect()->route('school_route.visa_service')
            ->with('success', 'Unit has created successfully');
    }
}
