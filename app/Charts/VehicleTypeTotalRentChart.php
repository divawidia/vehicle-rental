<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class VehicleTypeTotalRentChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        $vehicleTypeTotalRent = DB::table('vehicle_types')
            ->select('vehicle_types.*', DB::raw('COUNT(bookings.id) as total_sewa'))
            ->join('vehicles', 'vehicle_types.id', '=', 'vehicles.vehicle_type_id')
            ->join('bookings', 'vehicles.id', '=', 'bookings.vehicle_id')
            ->where(DB::raw('YEAR(bookings.created_at)'), DB::raw('YEAR(NOW())'))
            ->groupBy('vehicle_types.id')
            ->orderBy('total_sewa', 'desc')
            ->get();

        return $this->chart->donutChart()
            ->setTitle('Tipe Kendaraan Terlaris')
            ->addData(array_column($vehicleTypeTotalRent->toArray(), 'total_sewa'))
            ->setLabels(array_column($vehicleTypeTotalRent->toArray(), 'vehicle_type_name'));
    }
}
