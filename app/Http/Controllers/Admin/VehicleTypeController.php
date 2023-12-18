<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VehiclePhoto;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class VehicleTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = VehicleType::query();

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-dots-horizontal-rounded"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="' . route('tipe.edit', $item->id) . '">Edit</a>
                                </li>
                                <li>
                                <form action="' . route('tipe.destroy', $item->id) . '" method="POST">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button type="submit" class="dropdown-item">
                                        Hapus
                                    </button>
                                </form>
                                </li>
                            </ul>
                        </div>';
                })
                ->editColumn('icon', function ($item) {
                    return $item->icon ? '<img src="' . Storage::url($item->icon) . '"/>' : '';
                })
                ->rawColumns(['action', 'icon'])
                ->make();
        }

        return view('admin.pages.vehicle-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.vehicle-category.type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->vehicle_type_name);
        $data['icon'] = $request->file('icon')->store('assets/icons', 'public');

        VehicleType::create($data);

        return redirect()->route('vehicle-category-index')->with('status', 'Data Tipe Kendaraan berhasil ditambahkan!');
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
        $item = VehicleType::findOrFail($id);

        return view('admin.pages.vehicle-category.type.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->vehicle_type_name);
        $data['icon'] = $request->file('icon')->store('assets/icons', 'public');

        $item = VehicleType::findOrFail($id);
        $item->update($data);

        return redirect()->route('vehicle-category-index')->with('status', 'Data Tipe Kendaraan berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = VehicleType::findOrFail($id);
        $item->delete();

        return redirect()->route('vehicle-category-index')->with('status', 'Data Tipe Kendaraan berhasil dihapus!');
    }
}
