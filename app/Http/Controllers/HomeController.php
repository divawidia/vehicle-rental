<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Gallery;
use App\Models\Tag;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    public function vehicleList()
    {
        $vehicles = Vehicle::with('photos', 'transmission', 'vehicle_type', 'brand')->get();
        return view('pages.vehicle-list', compact('vehicles'));
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
        return view('pages.gallery', compact('galleries'));
    }

    public function bookingPage(){
        $vehicles = Vehicle::with('photos', 'transmission', 'vehicle_type', 'brand')->get();
        return view('pages.booking',[
            'vehicles' => $vehicles
        ]);
    }
}
