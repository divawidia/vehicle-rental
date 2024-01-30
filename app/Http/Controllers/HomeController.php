<?php

namespace App\Http\Controllers;

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
}
