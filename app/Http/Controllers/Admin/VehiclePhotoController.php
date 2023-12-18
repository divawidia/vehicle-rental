<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\VehiclePhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class VehiclePhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = VehiclePhoto::with(['vehicle']);

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <form action="' . route('foto-kendaraan.destroy', $item->id) . '" method="POST">
                            ' . method_field('delete') . csrf_field() . '
                            <button type="submit" class="btn btn-danger mx-1 my-1">
                                Hapus
                            </button>
                        </form>';
                })
                ->editColumn('photo_url', function ($item) {
                    return $item->photo_url ? '<img src="' . Storage::url($item->photo_url) . '" style="max-height: 80px;"/>' : '';
                })
                ->rawColumns(['action', 'photo_url'])
                ->make();
        }

        return view('admin.pages.vehicle-photo.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicles = Vehicle::all();

        return view('admin.pages.vehicle-photo.create',[
            'vehicles' => $vehicles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $data['photo_url'] = $request->file('photo_url')->store('assets/vehicle-photo', 'public');

        VehiclePhoto::create($data);

        return redirect()->route('foto-kendaraan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = VehiclePhoto::findorFail($id);
        $item->delete();

        return redirect()->route('foto-kendaraan.index');
    }
}
