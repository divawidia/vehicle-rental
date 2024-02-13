<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Gallery;
use App\Models\Tag;
use App\Models\Transmission;
use App\Models\Vehicle;
use App\Models\VehicleBrand;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $vehicles = Vehicle::with('photos', 'transmission', 'vehicle_type', 'brand')->get();
        return view('pages.home',[
            'vehicles' => $vehicles
        ]);
    }
    public function vehicleList(Request $request)
    {
        $vehicleTypes = VehicleType::all();
        $transmissions = Transmission::all();
        $brands = VehicleBrand::all();
//        dd(array($request->vehicle_type_id));
        if ($request->all() == []) {
            $previousData = [
                'vehicle_type_id' => [],
                'transmission_id' => [],
                'brand_id' => [],
                'engine_capacity_min' => 0,
                'engine_capacity_max' => 2000,
                'daily_price_min' => 0,
                'daily_price_max' => 3000000,
                'monthly_price_min' => 0,
                'monthly_price_max' => 3000000
            ];
        }else{
            $previousData = [
                'vehicle_type_id' => ($request->vehicle_type_id == null ? [] : $request->vehicle_type_id),
                'transmission_id' => ($request->transmission_id == null ? [] : $request->transmission_id),
                'brand_id' => ($request->brand_id == null ? [] : $request->brand_id),
                'engine_capacity_min' => 0,
                'engine_capacity_max' => 2000,
                'daily_price_min' => 0,
                'daily_price_max' => 3000000,
                'monthly_price_min' => 0,
                'monthly_price_max' => 3000000
            ];
        }

        $vehicles = Vehicle::query();
        if (isset($request->vehicle_type_id) && ($request->vehicle_type_id != null)){
            $vehicles->whereHas('vehicle_type', function ($vehicle) use ($request){
                $vehicle->whereIn('id', $request->vehicle_type_id);
            });
        }
        if (isset($request->transmission_id) && ($request->transmission_id != null)){
            $vehicles->whereHas('transmission', function ($vehicle) use ($request){
                $vehicle->whereIn('id', $request->transmission_id);
            });
        }
        if (isset($request->brand_id) && ($request->brand_id != null)){
            $vehicles->whereHas('brand', function ($vehicle) use ($request){
                $vehicle->whereIn('id', $request->brand_id);
            });
        }
        if (isset($request->engine_capacity_min) && ($request->engine_capacity_min != null)){
            $vehicles->where('engine_capacity', '>=', $request->engine_capacity_min);
        }
        if (isset($request->engine_capacity_max) && ($request->engine_capacity_max != null)){
            $vehicles->where('engine_capacity', '<=', $request->engine_capacity_max);
        }
        if (isset($request->daily_price_min) && ($request->daily_price_min != null)){
            $vehicles->where('daily_price', '>=', $request->daily_price_min);
        }
        if (isset($request->daily_price_max) && ($request->daily_price_max != null)){
            $vehicles->where('daily_price', '<=', $request->daily_price_max);
        }
        if (isset($request->monthly_price_min) && ($request->monthly_price_min != null)){
            $vehicles->where('monthly_price', '>=', $request->monthly_price_min);
        }
        if (isset($request->monthly_price_max) && ($request->monthly_price_max != null)){
            $vehicles->where('monthly_price', '<=', $request->monthly_price_max);
        }
        $vehicles = $vehicles->get();


        return view('pages.vehicle-list', compact('vehicles', 'vehicleTypes', 'transmissions', 'brands', 'previousData'));
    }
    public function vehicleDetail(Request $request, string $slug)
    {
        $booking = $request->session()->get('booking');
        $vehicle = Vehicle::where('slug', $slug)->first();
        $vehicleUnit = DB::table('vehicle_details')
            ->where('vehicle_details.status', '=', 'tersedia')
            ->where('vehicle_details.vehicle_id', $vehicle->id)
            ->count();
//        dd($vehicleUnit);
        return view('pages.vehicle-detail', compact(['vehicle', 'vehicleUnit', 'booking']));
    }

//    public function filter_vehicle(Request $request)
//    {
//        $vehicles = DB::table('vehicles')
//            ->where(function ($q) use ($request) {
//
//                if ($request->has('vehicle_type_id')) {
//                    foreach ($request->vehicle_type_id as $vehicle_type_id){
//                        $q->orWhere('vehicle_type_id',$request->vehicle_type_id );
//                    }
//                    $q->orWhere('vehicle_type_id',$request->vehicle_type_id )
//                        ->orWhere('vehicle_type_id',$request->vehicle_type_id )
//                        ->orWhere('vehicle_type_id',$request->vehicle_type_id )
//                } else {
//                    if ($request->has('type')) {
//                        $q->where($request->type, 'LIKE', '%' . $request->search . '%');
//                    }
//                    if ($request->has('object_type')) {
//                        $q->where('object_type', 'LIKE', '%' . $request->object_type . '%');
//                    }
//                    if ($request->has('launch_year')) {
//                        $q->where('launch', 'LIKE', '%' . $request->launch_year . '%');
//                    }
//                }
//            })
//        return view('search_result',compact('all_products'))->render();
//    }

    public function blogList()
    {
        $blogs = Blog::with('user', 'tags')
            ->where('status','1')
            ->get();
        $tags = Tag::all();
        return view('pages.blog', compact(['blogs', 'tags']));
    }

    public function blogDetail(string $slug)
    {
        $blogs = Blog::where('status','1')->get();
        $tags = Tag::all();
        return view('pages.blog-detail', compact(['blogs', 'tags']))->with('blog', Blog::where('slug', $slug)->first());
    }

    public function gallery()
    {
        $galleries = Gallery::all();
        $items = [];
        foreach ($galleries as $gallery) {
            $items[] = [
                'src' => asset('/storage/'.$gallery->photo_url),
                'srct' => asset('/storage/'.$gallery->photo_url),
                'title' => '',
            ];
        }

        return view('pages.gallery', compact('items'));
    }

    public function bookingPage(Request $request){
        $booking = $request->session()->get('booking');
        $vehicleTypes = VehicleType::all();
        return view('pages.booking', compact(['booking', 'vehicleTypes']));
    }
}
