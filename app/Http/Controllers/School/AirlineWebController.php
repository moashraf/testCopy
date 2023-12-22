<?php

namespace App\Http\Controllers\School;

use App\Http\Controllers\Controller;
use App\Models\Branch\Branch;
use App\Models\Branch\Image_unit;
use App\Models\Branch\Order;
use App\Models\Branch\Package;
use App\Models\Branch\Slider;
use App\Models\Branch\Tag;
use App\Models\Branch\Trip;
use App\Models\Branch\Trip_offer;
use App\Models\Branch\Unit;
use App\Models\Branch\Unit_tag;
use App\Models\Invoice\Debtor;
use App\Models\location\Country;
use App\Models\location\CountryWantBook;
use App\Models\Patient\Bus;
use App\Models\Patient\Bus_company;
use App\Models\Patient\Bus_trip;
use App\Models\Patient\Destination;
use App\Models\Patient\Specialty_cat;
use Google\Service\Compute\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AirlineWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $destinations = Destination::get();
        return view('website/airline.index', compact('destinations'));
    }

    public function transp_search(Request $request)
    {

        $this->validate($request, [
            'type' => ['required', Rule::in(['single', 'round']),],
            'from' => 'required|exists:destinations,id',
            'to' => 'required|exists:destinations,id',
            'date_from' => 'required|date',
            'date_to' => 'date',
        ]);

        $type = $request->input('type');
        $from = $request->input('from');
        $to = $request->input('to');
        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');

        $bus_round = "";

        if ($type === "single") {
            $bus_single = Bus_trip::where('from_id', $from)->where('to_id', $to)->whereDate('date', $date_from);

            //features
            if (!empty($_GET['features'])) {
                $features = explode(',', $_GET['features']);
                foreach ($features as $feature) {
                    $bus_single = $bus_single->whereHas('bus', function ($q) use ($feature) {
                        $q->where($feature, 1);
                    });
                }
            }

            if (!empty($_GET['company'])) {
                $companies = explode(',', $_GET['company']);
                $bus_single = $bus_single->whereHas('bus', function ($q) use ($companies) {
                    $q->whereHas('company', function ($q) use ($companies) {
                        $q->whereIn("slug", $companies);
                    });
                });
            }

            //features
            if (!empty($_GET['seats'])) {
                $seats = $_GET['seats'];
                if ($seats) {
                    if ($seats === "more") {
                        $bus_single = $bus_single->whereHas('bus', function ($q) use ($seats) {
                            $q->where('seats', ">", $seats);
                        });
                    } else {
                        $bus_single = $bus_single->whereHas('bus', function ($q) use ($seats) {
                            $q->where('seats', $seats);
                        });
                    }
                }
            }

            $bus_single = $bus_single->get();
        } else {
            $bus_single = Bus_trip::where('from_id', $from)->where('to_id', $to)->whereDate('date', $date_from)->get();
            $bus_round = Bus_trip::where('from_id', $to)->where('to_id', $from)->whereDate('date', $date_to)->get();
        }

        $bus = Bus::limit(10)->get();

        if (!empty($bus_single[0])) {
            $from_name = $bus_single[0]->from->name;
            $to_name = $bus_single[0]->to->name;
        } else {
            $from_name = "";
            $to_name = "";
        }
        $destination = Destination::select('id', 'name')->get();

        $companies = Bus_company::select('id', 'slug', 'name')->get();

        return view('website/transp.show', compact('bus_single', 'bus_round', 'bus', 'from', 'to', 'type', 'date_from', 'date_to', 'from_name', 'to_name', 'destination', 'companies'));
    }





    public function transp_search_filter(Request $request)
    {

        $price_url = "";
        if (!empty($request->input('price'))) {
            if (empty($price_url)) {
                $price_url .= '&price=' . $request->input('price');
            } else {
                $price_url .= ',' . $request->input('price');
            }
        } // end if condition 


        //style
        $feature_url = "";
        if (!empty($request->input('features'))) {
            foreach ($request->input('features') as $feature_item) {
                if (empty($feature_url)) {
                    $feature_url .= '&features=' . $feature_item;
                } else {
                    $feature_url .= ',' . $feature_item;
                }
            }
        }

        $seats_url = "";
        if (!empty($request->input('seats'))) {
            if (empty($seats_url)) {
                $seats_url .= '&seats=' . $request->input('seats');
            } else {
                $seats_url .= ',' . $request->input('seats');
            }
        } // end if condition 


        //company
        $company_url = "";
        if (!empty($request->input('company'))) {
            foreach ($request->input('company') as $company_item) {
                if (empty($company_url)) {
                    $company_url .= '&company=' . $company_item;
                } else {
                    $company_url .= ',' . $company_item;
                }
            }
        }

        // -------- defult url search ---------
        $type = '&type=' . $request->input('type');
        $from = '&from=' . $request->input('from');
        $to = '&to=' . $request->input('to');
        $date_from = '&date_from=' . $request->input('date_from');
        $date_to = '&date_to=' . $request->input('date_to');

        if ($request->input('date_to')) {
            return redirect()->route('school_route.transp_search', $type . $from . $to . $date_from . $date_to . $price_url . $feature_url . $company_url . $seats_url);
        } else {
            return redirect()->route('school_route.transp_search', $type . $from . $to . $date_from . $price_url . $feature_url . $company_url . $seats_url);
        }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::get();
        $destinations = Destination::get();
        $units = Unit::get();
        $packages = Package::get();

        return view('cats/slider.create', compact('tags', 'destinations', 'units', 'packages'));
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
                'name' => 'required|max:100|min:3',
                'description' => 'required|max:200|min:4',
                'img' => 'required|image|mimes:jpeg,jpg,png|max:1000',
                'service_type' => 'required',
            ]
        );

        if ($request->hasFile('img')) {
            $file_extension = request()->img->getClientOriginalExtension();
            $file_name = $request->input('name') . 'slider' . time() . '.' . $file_extension;
            $path = 'img/sliders';
            $request->img->move($path, $file_name);
        } else {
            $file_name = "";
        }

        $service_type = $request->input('service_type');

        if ($service_type == 1) {
            $service_id = $request->input('tag');
        } elseif ($service_type == 2) {
            $service_id = $request->input('destination');
        } elseif ($service_type == 3) {
            $service_id = $request->input('unit');
        } elseif ($service_type == 4) {
            $service_id = $request->input('package');
        }

        $unit = Slider::create([
            'type' => $request->input('type'),
            'name' => $request->input('name'),
            'img' => $file_name,
            'description' => $request->input('description'),
            'service_type' => $service_type,
            'service_id' => $service_id,
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

        $unit = Trip::find($id);

        $tags = $unit->tags()->pluck('tag_id')->toArray();

        $related_hotels = Trip::whereHas('tags', function ($q) use ($tags) {
            $q->whereIn('tag_id', $tags);
        })
            ->get();

        $offer = Trip_offer::where('trip_id', $id)->first();

        return view('website.trip.show', compact('unit', 'related_hotels', 'offer'));
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

        $tags = Tag::get();
        $destinations = Destination::get();
        $units = Unit::get();
        $packages = Package::get();

        return view('cats/slider.edit', compact('slider', 'tags', 'destinations', 'units', 'packages'));
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
                'name' => 'required|max:100|min:3',
                'description' => 'required|max:200|min:4',
                'img' => 'required|image|mimes:jpeg,jpg,png|max:1000',
                'service_type' => 'required',
            ]
        );

        $service_type = $request->input('service_type');

        if ($service_type == 1) {
            $service_id = $request->input('tag');
        } elseif ($service_type == 2) {
            $service_id = $request->input('destination');
        } elseif ($service_type == 3) {
            $service_id = $request->input('unit');
        } elseif ($service_type == 4) {
            $service_id = $request->input('package');
        }

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
            $file_name = $request->input('name') . 'slider' . time() . '.' . $file_extension;
            $path = 'img/sliders';
            $request->img->move($path, $file_name);
            $slider->img = $file_name; //new img file name
        }

        $slider->type = $request->input('type');
        $slider->name = $request->input('name');
        $slider->description = $request->input('description');
        $slider->service_type = $request->input('service_type');
        $slider->service_id = $service_id;
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
