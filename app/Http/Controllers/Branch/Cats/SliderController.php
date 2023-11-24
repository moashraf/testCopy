<?php

namespace App\Http\Controllers\Branch\Cats;

use App\Http\Controllers\Controller;
use App\Models\Branch\Branch;
use App\Models\Branch\Image_unit;
use App\Models\Branch\Order;
use App\Models\Branch\Package;
use App\Models\Branch\Slider;
use App\Models\Branch\Tag;
use App\Models\Branch\Trip;
use App\Models\Branch\Unit;
use App\Models\Branch\Unit_tag;
use App\Models\Branch\Visa;
use App\Models\Invoice\Debtor;
use App\Models\location\Country;
use App\Models\location\CountryWantBook;
use App\Models\Patient\Destination;
use App\Models\Patient\Specialty_cat;
use App\Models\Patient\Vehicle;
use Google\Service\Compute\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::get();

        return view('cats/slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cats/slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate(
            $request,
            [
                'type' => 'required',
                'name' => 'required|min:3',
                'description' => 'required|min:4',
                'img' => 'required|image|mimes:jpeg,jpg,png|max:1000',
            ]
        );

        if ($request->hasFile('img')) {
            $file_extension = request()->img->getClientOriginalExtension();
            $file_name = 'slider' . time() . '.' . $file_extension;
            $path = 'img/sliders';
            $request->img->move($path, $file_name);
        } else {
            $file_name = "";
        }


        $unit = Slider::create([
            'type' => $request->input('type'),
            'name' => $request->input('name'),
            'img' => $file_name,
            'description' => $request->input('description'),
        ]);

        return redirect()->route('sett.slider.index')
            ->with('success', 'Slider has created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slider = Slider::find($id);

        return view('cats/slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'type' => 'required',
                'name' => 'required|min:3',
                'description' => 'required|min:4',
                'img' => 'image|mimes:jpeg,jpg,png|max:1000',
            ]
        );

        $slider = Slider::find($id);

        //update img
        if ($request->hasFile('img')) {
            if ($slider->img) {
                //to remove the old avatar and also keep the default img
                $imagePath = public_path('img/sliders' . $slider->img);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }
            $file_extension = request()->img->getClientOriginalExtension();
            $file_name = 'slider' . time() . '.' . $file_extension;
            $path = 'img/sliders';
            $request->img->move($path, $file_name);
            $slider->img = $file_name; //new img file name
        }

        $slider->type = $request->input('type');
        $slider->name = $request->input('name');
        $slider->description = $request->input('description');
        $slider->save();

        return redirect()->route('sett.slider.index')
            ->with('success', 'Slider has updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
