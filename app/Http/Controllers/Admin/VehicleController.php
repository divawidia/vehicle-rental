<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleRequest;
use App\Models\Booking;
use App\Models\ProductGallery;
use App\Models\Transmission;
use App\Models\Vehicle;
use App\Models\VehicleBrand;
use App\Models\VehicleDetail;
use App\Models\VehicleFeature;
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
                    return $item->thumbnail ? '<img src="' . Storage::url($item->thumbnail) . '" style="max-height: 80px;"/>' : '';
                })
                ->rawColumns(['action', 'foto'])
                ->make();
        }

        return view('admin.pages.vehicle.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicleTypes = VehicleType::all();
        $transmissions = Transmission::all();
        $brands = VehicleBrand::all();

        return view('admin.pages.vehicle.create',[
            'vehicleTypes' => $vehicleTypes,
            'transmissions' => $transmissions,
            'brands' => $brands
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VehicleRequest $request)
    {
        $data = $request->all();
        $data['slug'] = Str::slug($request->vehicle_name);

        $data['thumbnail'] = $request->file('thumbnail')->store('assets/vehicle-photo', 'public');
        $vehicle = Vehicle::create($data);
        foreach($request->features as $feature) {
            $vehicle_feature['vehicle_id'] = $vehicle->id;
            $vehicle_feature['feature'] = $feature;
            VehicleFeature::create($vehicle_feature);
        }

        return redirect()->route('kendaraan.index')->with('status', 'Data Kendaraan berhasil ditambahkan!');
    }

    public function storeVehicleDetail(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $data = $request->all();
        $data['vehicle_id'] = $vehicle->id;

//        dd($data);
        VehicleDetail::create($data);
//        foreach($request->features as $feature) {
//            $vehicle_feature['vehicle_id'] = $vehicle->id;
//            $vehicle_feature['feature'] = $feature;
//            VehicleFeature::create($vehicle_feature);
//        }

        return redirect()->route('kendaraan.show', $vehicle->id)->with('status', 'Data detail kendaraan berhasil ditambahkan!');
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
//        return view('admin.pages.vehicle.detail');
        return view('admin.pages.vehicle.detail')->with('vehicle', Vehicle::where('id', $id)->first());
    }

    public function indexVehicleDetail($id)
    {
        if (request()->ajax()) {
            $query = VehicleDetail::where('vehicle_id', $id)->get();

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bx-dots-horizontal-rounded"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="' . route('edit-detail-kendaraan',['vehicle_id' => $item->vehicle_id, 'id'=>$item->id]) . '">Edit</a>
                                </li>
                                <li>
                                <form action="' . route('hapus-detail-kendaraan', ['vehicle_id' => $item->vehicle_id, 'id'=>$item->id]) . '" method="POST">
                                    ' . method_field('delete') . csrf_field() . '
                                    <button type="submit" class="dropdown-item">
                                        Hapus
                                    </button>
                                </form>
                                </li>
                            </ul>
                        </div>';
                })
                ->rawColumns(['action'])
                ->make();
        }

        return route('kendaraan.show', $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kendaraan = Vehicle::with((['photos', 'vehicle_type', 'brand', 'transmission', 'features']))->findOrFail($id);
        $vehicleTypes = VehicleType::all();
        $transmissions = Transmission::all();
        $brands = VehicleBrand::all();

        return view('admin.pages.vehicle.edit',[
            'kendaraan' => $kendaraan,
            'vehicleTypes' => $vehicleTypes,
            'transmissions' => $transmissions,
            'brands' => $brands
        ]);
    }

    public function editVehicleDetail(string $vehicle_id, string $id)
    {
        $vehicleDetail = VehicleDetail::findOrFail($id);
//        dd($vehicleDetail);

        return view('admin.pages.vehicle.edit-vehicle-detail',[
            'vehicleDetail' => $vehicleDetail
        ]);
    }

//    public function uploadPhoto(Request $request){
//        $data = $request->all();
//
//        $data['photo_url'] = $request->file('photo_url')->store('assets/vehicle-photo', 'public');
//
//        VehiclePhoto::create($data);
//
//        return redirect()->route('kendaraan.edit', $request->vehicle_id);
//    }
    public function uploadDescPhoto(Request $request, Vehicle $vehicle){
        if ($request->hasFile('upload')) {
            $photo = $request->file('upload')->store('assets/vehicle-photo', 'public');
            $filename = pathinfo($photo, PATHINFO_FILENAME);
            $extension = pathinfo($photo, PATHINFO_EXTENSION);

            return response()->json(['fileName'=>$filename . '.' . $extension, 'uploaded' => 1, 'url' => Storage::url($photo)]);
        }
    }

    public function uploadPhoto(Request $request) {
        $data = [];
            $data['photo_url'] = $request->file('file')->store('assets/vehicle-photo', 'public');
            $data['vehicle_id'] = $request->vehicle_id;
            VehiclePhoto::create($data);
        return response()->json(['success'=>$data['photo_url']]);
    }

    public function deletePhoto(Request $request, $id)
    {
        $item = VehiclePhoto::findOrFail($id);
        $item->delete();

        return redirect()->route('kendaraan.edit', $item->vehicle_id);
    }

    public function addFeature(Request $request)
    {
//        dd($request);
        $feature['vehicle_id'] = $request->vehicle_id;
        $feature['feature'] = $request->features;
        VehicleFeature::create($feature);

        return redirect()->route('kendaraan.edit', $feature['vehicle_id']);
    }

    public function deleteFeature($id)
    {
        $feature = VehicleFeature::findOrFail($id);
        $feature->delete();

        return redirect()->route('kendaraan.edit', $feature->vehicle_id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VehicleRequest $request, string $id)
    {
        $data = $request->all();

        $vehicle = Vehicle::findOrFail($id);

        $data['slug'] = Str::slug($request->vehicle_name);
        if ($request->hasFile('thumbnail')){
            $data['thumbnail'] = $request->file('thumbnail')->store('assets/vehicle-photo', 'public');
        }

        $vehicle->update($data);

        return redirect()->route('kendaraan.index')->with('status', 'Data kendaraan berhasil diedit!');
    }

    public function updateVehicleDetail(Request $request, string $id)
    {
        $data = $request->all();

        $vehicleDetail = VehicleDetail::findOrFail($id);;
        $kendaraan = Vehicle::findOrFail($vehicleDetail->vehicle_id);
        $vehicleDetail->update($data);

        return redirect()->route('kendaraan.show', ["kendaraan"=>$kendaraan])->with('status', 'Data detail kendaraan berhasil diedit!');
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

    public function destroyVehicleDetail(string $vehicle_id,string $id)
    {
        $vehicle = Vehicle::findOrFail($vehicle_id);

        $vehicleDetail = VehicleDetail::findOrFail($id);

        $vehicleDetail->delete();

        return redirect()->route('kendaraan.show', $vehicle->id)->with('status', 'Data detail kendaraan berhasil dihapus!');
    }
}
