<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Gallery;
use App\Models\Tag;
use App\Models\Vehicle;
use Illuminate\Http\Request;

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
    public function vehicleDetail(string $slug)
    {
        return view('pages.vehicle-detail')->with('vehicle', Vehicle::where('slug', $slug)->first());
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
}
