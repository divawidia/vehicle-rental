<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\ProductGallery;
use App\Models\Transmission;
use App\Models\Vehicle;
use App\Models\VehicleBrand;
use App\Models\VehiclePhoto;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Vehicle::with(['transmission', 'vehicle_type', 'brand', 'photos']);

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-dots-horizontal-rounded"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="' . route('kendaraan.edit', $item->id) . '">Edit</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="' . route('kendaraan.show', $item->id) . '">Detail</a>
                                </li>
                                <li>
                                <form action="' . route('kendaraan.destroy', $item->id) . '" method="POST">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button type="submit" class="dropdown-item">
                                        Hapus
                                    </button>
                                </form>
                                </li>
                            </ul>
                        </div>';
                })
                ->editColumn('foto', function ($item) {
                    return $item->photos[0]->photo_url ? '<img src="' . Storage::url($item->photos[0]->photo_url) . '" style="max-height: 80px;"/>' : '';
                })
                ->rawColumns(['action', 'foto'])
                ->make();
        }

        return view('pages.admin.vehicle.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicleTypes = VehicleType::all();
        $transmissions = Transmission::all();
        $brands = VehicleBrand::all();

        return view('pages.admin.vehicle.create',[
            'vehicleTypes' => $vehicleTypes,
            'transmissions' => $transmissions,
            'brands' => $brands
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $data['slug'] = Str::slug($request->vehicle_name);

        $vehicle = Vehicle::create($data);

        $gallery = [
            'vehicle_id' => $vehicle->id,
            'photo_url' => $request->file('photo_url')->store('assets/vehicle-photo', 'public')
        ];

        VehiclePhoto::create($gallery);

//        foreach ($request->file('photo_url') as $photo){
//            $dataPhoto['vehicle_id'] = $vehicle->id;
//            $dataPhoto['photo_url'] = $photo->store('assets/vehicle-photo', 'public');
//            VehiclePhoto::create($dataPhoto);
//        }
        return redirect()->route('kendaraan.index')->with('status', 'Data Kendaraan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (request()->ajax()) {
            $query = Booking::where('vehicle_id', $id)->get();

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-dots-horizontal-rounded"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="' . route('bookings.edit', $item->id) . '">Edit</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="' . route('bookings.show', $item->id) . '">Detail</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="' . route('booking-invoice', $item->id) . '">Invoice</a>
                                </li>
                                <li>
                                <form action="' . route('bookings.destroy', $item->id) . '" method="POST">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button type="submit" class="dropdown-item">
                                        Hapus
                                    </button>
                                </form>
                                </li>
                            </ul>
                        </div>';
                })
                ->editColumn('booking_status', function ($item){
                    if ($item->booking_status == 'Selesai') {
                        $badge = '<span class="badge bg-success">' . $item->booking_status; '</span>';
                    }elseif ($item->booking_status == 'Sedang Disewa'){
                        $badge = '<span class="badge bg-warning">' . $item->booking_status; '</span>';
                    }else{
                        $badge = '<span class="badge bg-danger">' . $item->booking_status; '</span>';
                    }
                    return $badge;
                })
                ->editColumn('transaction_status', function ($item){
                    if ($item->transaction_status == 'Belum Dibayar') {
                        $badge = '<span class="badge bg-warning">' . $item->transaction_status; '</span>';
                    }else{
                        $badge = '<span class="badge bg-success">' . $item->transaction_status; '</span>';
                    }
                    return $badge;
                })
                ->editColumn('shipping_status', function ($item){
                    if ($item->shipping_status == 'Belum') {
                        $badge = '<span class="badge bg-warning">' . $item->shipping_status; '</span>';
                    }else{
                        $badge = '<span class="badge bg-success">' . $item->shipping_status; '</span>';
                    }
                    return $badge;
                })
                ->editColumn('return_status', function ($item){
                    if ($item->return_status == 'Belum') {
                        $badge = '<span class="badge bg-warning">' . $item->return_status; '</span>';
                    }else{
                        $badge = '<span class="badge bg-success">' . $item->return_status; '</span>';
                    }
                    return $badge;
                })
                ->editColumn('created_at', function ($item){
                    $date = strtotime($item->created_at);
                    return date('l, M d, Y. h:i A',$date);
                })
                ->editColumn('pick_up_datetime', function ($item){
                    $date = strtotime($item->pick_up_datetime);
                    return date('l, M d, Y. h:i A',$date);
                })
                ->editColumn('return_datetime', function ($item){
                    $date = strtotime($item->return_datetime);
                    return date('l, M d, Y. h:i A',$date);
                })
                ->editColumn('whatsapp', function ($item){
                    return '<a
                        href="https://wa.me/' . $item->no_hp_wa .'"
                        class="btn btn-success mx-1 my-1"
                    ><i class="bx bxl-whatsapp"></i></a>';
                })
                ->editColumn('name', function ($item){
                    return '<p>' . $item->first_name . ' ' . $item->last_name . '</p>';
                })
                ->editColumn('total_days_rent', function ($item){
                    return '<p>' . $item->total_days_rent . ' Hari</p>';
                })
                ->editColumn('total_price', function ($item){
                    return 'Rp. ' . number_format($item->total_price);
                })
                ->rawColumns(['action', 'booking_status', 'transaction_status', 'shipping_status', 'return_status', 'created_at', 'pick_up_datetime', 'return_datetime', 'whatsapp', 'name', 'total_days_rent'])
                ->make();
        }
//        return view('pages.admin.vehicle.detail');
        return view('pages.admin.vehicle.detail')->with('vehicle', Vehicle::where('id', $id)->first());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $vehicle = Vehicle::with((['photos', 'vehicle_type', 'brand', 'transmission']))->findOrFail($id);
        $vehicleTypes = VehicleType::all();
        $transmissions = Transmission::all();
        $brands = VehicleBrand::all();

        return view('pages.admin.vehicle.edit',[
            'vehicle' => $vehicle,
            'vehicleTypes' => $vehicleTypes,
            'transmissions' => $transmissions,
            'brands' => $brands
        ]);
    }

    public function uploadPhoto(Request $request){
        $data = $request->all();

        $data['photo_url'] = $request->file('photo_url')->store('assets/vehicle-photo', 'public');

        VehiclePhoto::create($data);

        return redirect()->route('kendaraan.edit', $request->vehicle_id);
    }

    public function deletePhoto(Request $request, $id)
    {
        $item = VehiclePhoto::findOrFail($id);
        $item->delete();

        return redirect()->route('kendaraan.edit', $item->vehicle_id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();

        $vehicle = Vehicle::findOrFail($id);

        $data['slug'] = Str::slug($request->vehicle_name);

        $vehicle->update($data);

        return redirect()->route('kendaraan.index')->with('status', 'Data kendaraan berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();

        return redirect()->route('kendaraan.index')->with('status', 'Data kendaraan berhasil dihapus!');
    }
}
