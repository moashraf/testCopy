<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Models\location\Country;
use App\Models\Patient\Service_inv_cat as PatientService_inv_cat;
use App\Models\Patient\Image_destination;
use App\Models\Patient\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;



class DestinationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $destination = Destination::get();
        return view('destinations.index', compact('destination'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::orderBy('fav', 'DESC')
            ->get();
        return view('destinations.create', compact('countries'));
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
                'image' => 'required|image|mimes:jpeg,jpg,png|max:800',
                'country_id' => 'required|exists:countries,id',
                'name' => 'required|max:50|min:4|unique:destinations,name',
                'slug' => 'required|max:50|min:4|unique:destinations,slug',
                'short_description' => 'required|max:250|min:10',
                'description' => 'required',
                'all_imgs.*' => 'required|image|mimes:jpeg,jpg,png|max:2000|dimensions:max_width:1280,max_height:900',
            ]
        );

        if ($request->hasFile('image')) {
            $file_extension = request()->image->getClientOriginalExtension();
            $file_name = $request->input('name') . time() . '.' . $file_extension;
            $path = 'img/destination';
            $request->image->move($path, $file_name);
        }

        // if ($request->hasFile('cover_image')) {
        //     $file_extension = request()->cover_image->getClientOriginalExtension();
        //     $file_name = $request->input('name') . time() . '.' . $file_extension;
        //     $path = 'img/products';
        //     $request->cover_image->move($path, $file_name);
        // }

        // insert table station
        $destinations = Destination::create([
            'image' => $file_name,
            // 'cover_image' => $file_name,
            'name' => $request->input('name'),
            'country_id' => $request->input('country_id'),
            'slug' => $request->input('slug'),
            'description' => $request->input('description'),
            'short_description' => $request->input('short_description'),
            'show_hp' => !empty($request->input('show_hp')) ? 1 : 0,
            'hp_favorite' => !empty($request->input('hp_favorite')) ? 1 : 0,
        ]);

        // insert in table Image Station
        if ($request->hasFile('all_imgs')) {
            $images = $request->file('all_imgs');
            foreach ($images as $key => $image) {
                $imageName = time()  . $key . '.' . $image->getClientOriginalExtension();
                $request['destination_id'] = $destinations->id;
                $request['destination_images'] = $imageName;
                $image->move(public_path('img/destination'), $imageName);
                Image_destination::create($request->all());
            }
        }
        // return $station
        session()->flash('success', 'The brand has been created');
        return redirect()->route('sett.destinations.index');
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

        $destination = Destination::find($id);
        $countries = Country::orderBy('fav', 'DESC')->get();

        return view('destinations.edit', compact('destination', 'countries'));
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
        //
        $destinations = Destination::find($id);
        $destinations->country_id = $request->input('country_id');
        $destinations->name = $request->input('name');
        $destinations->slug = $request->input('slug');
        $destinations->description = $request->input('description');
        $destinations->short_description = $request->input('short_description');
        $destinations->show_hp = !empty($request->input('show_hp')) ? 1 : 0;
        $destinations->hp_favorite = !empty($request->input('hp_favorite')) ? 1 : 0;

        //insert img
        if ($request->hasFile('image')) {
            if ($destinations->image) {
                //to remove the old avatar and also keep the default img
                $imagePath = public_path('img/destination' . $destinations->image);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }
            $file_extension = request()->image->getClientOriginalExtension();
            $file_name = $request->input('name') . time() . '.' . $file_extension;
            $path = 'img/destination';
            $request->image->move($path, $file_name);
            $destinations->image = $file_name; //new img file name
        } else {
            $file_name = request()->image;
        }



        $destinations->save();
        // insert img in update

        if ($request->hasFile('all_imgs')) {
            $images = $request->file('all_imgs');
            foreach ($images as $key => $image) {
                $imageName = time()  . $key . '.' . $image->getClientOriginalExtension();
                $request['destination_id'] = $destinations->id;
                $request['destination_images'] = $imageName;
                $image->move(public_path('img/destination'), $imageName);
                Image_destination::create($request->all());
            }
        }
        session()->flash('success', 'The brand has been updated');
        return redirect()->route('sett.destinations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id =  $request->input('station_id');
        $destinations = Destination::find($id);
        $destinations->delete();
        session()->flash('success', 'The user has been deleted');
        return redirect()->route('sett.destinations.index');
    }


    public function deleteImage($id)
    {
        $img = Image_destination::find($id);
        $imagePath = public_path('img/destination' . $img->destination_images);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
        $img->delete();
        session()->flash('success', 'The image has been deleted ');
        return back();
    }


    public function fetch_destination_country($id)
    {
        return Destination::where('country_id', $id)->get();
    }
}
