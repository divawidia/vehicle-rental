<?php

namespace App\Http\Controllers\Admin;

use App\Charts\MonthTotalSalesChart;
use App\Charts\TodayTotalSalesChart;
use App\Charts\VehicleTypeTotalRentChart;
use App\Charts\WeekTotalSalesChart;
use App\Charts\YearTotalSalesChart;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use function MongoDB\BSON\toJSON;

class DashboardController extends Controller
{
    public function totalRentCountry(){
        $yearlyTotalRent = DB::table('bookings')
            ->select('country', DB::raw('COUNT(bookings.id) as total_sewa'), DB::raw('SUM(bookings.total_price) as total_penjualan'))
            ->where(DB::raw('YEAR(bookings.created_at)'), DB::raw('YEAR(NOW())'))
            ->groupBy('country')
            ->orderBy('total_sewa', 'desc')
            ->get();

        return response()->json($yearlyTotalRent);
    }

    public function index(MonthTotalSalesChart $monthTotalSales,
                          YearTotalSalesChart $yearTotalSales,
                          WeekTotalSalesChart $weekTotalSalesChart,
                          TodayTotalSalesChart $todayTotalSalesChart,
                          VehicleTypeTotalRentChart $vehicleTypeTotalRentChart)
    {
        $yearlyTotalSales = DB::table('bookings')
                                ->select(DB::raw('SUM(total_price) as total_sales'))
                                ->where('transaction_status', 'Sudah Dibayar')
                                ->where(DB::raw('YEAR(created_at)'), DB::raw('YEAR(NOW())'))
                                ->groupBy(DB::raw('YEAR(created_at)'))
                                ->get();

        $yearlyTotalRent = DB::table('bookings')
                                ->where(DB::raw('YEAR(created_at)'), DB::raw('YEAR(NOW())'))
                                ->count();

        $vehicles = DB::table('vehicles')
            ->join('vehicle_details', 'vehicles.id','=','vehicle_details.vehicle_id')
            ->select('vehicles.*', DB::raw('COUNT(vehicle_details.id) as unit_available'))
            ->where('vehicle_details.status', '=', 'tersedia')
            ->groupBy('vehicles.id')
            ->count();

        $totalBooking = DB::table('bookings')
            ->where('rent_status', 'Dibooking')
            ->count();

        $yearlyKendaraanTerlaris = DB::table('vehicles')
            ->select('vehicles.*', DB::raw('COUNT(bookings.id) as total_sewa'), DB::raw('SUM(bookings.total_price) as total_penjualan'))
            ->join('bookings', 'vehicles.id', '=', 'bookings.vehicle_id')
            ->where('transaction_status', 'Sudah Dibayar')
            ->where(DB::raw('YEAR(bookings.created_at)'), DB::raw('YEAR(NOW())'))
            ->groupBy('bookings.vehicle_id')
            ->orderBy('total_sewa', 'desc')
            ->get();

        $yearlyCountryTotalRent = DB::table('bookings')
            ->select('country', 'country_code', DB::raw('COUNT(bookings.id) as total_sewa'), DB::raw('SUM(bookings.total_price) as total_pendapatan'))
            ->where(DB::raw('YEAR(bookings.created_at)'), DB::raw('YEAR(NOW())'))
            ->groupBy(['country', 'country_code'])
            ->orderBy('total_sewa', 'desc')
            ->get();

        $yearlyCountryTotalRentData = [];
        foreach ($yearlyCountryTotalRent as $country){
            $yearlyCountryTotalRentData[$country->country_code] = $country->total_sewa;
        }
//        dd(json_encode($yearlyCountryTotalRentData));

        return view('pages.admin.dashboard', [
            'monthTotalSales' => $monthTotalSales->build(),
            'yearTotalSales' => $yearTotalSales->build(),
            'weekTotalSalesChart' => $weekTotalSalesChart->build(),
            'todayTotalSalesChart' => $todayTotalSalesChart->build(),
            'yearlyTotalSales' => $yearlyTotalSales,
            'yearlyTotalRent' => $yearlyTotalRent,
            'vehicles' => $vehicles,
            'totalBooking' => $totalBooking,
            'yearlyKendaraanTerlaris' => $yearlyKendaraanTerlaris,
            'vehicleTypeTotalRentChart' => $vehicleTypeTotalRentChart->build(),
            'yearlyCountryTotalRent' => $yearlyCountryTotalRent,
            'yearlyCountryTotalRentData' => $yearlyCountryTotalRentData
        ]);
    }
}
