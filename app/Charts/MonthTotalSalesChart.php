<?php

namespace App\Charts;

use App\Models\Booking;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class MonthTotalSalesChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $salesData = DB::table('bookings')->select(DB::raw('SUM(total_price) as total_sales'))->where('transaction_status', 'Sudah Dibayar')->groupBy(DB::raw('MONTH(pick_up_datetime)'))->get();
        $month = DB::table('bookings')->select(DB::raw('MONTHNAME(pick_up_datetime) as month'))->where('transaction_status', 'Sudah Dibayar')->groupBy(DB::raw('MONTHNAME(pick_up_datetime)'))->get();
//        dd(array_column($month->toArray(), 'month'));
        return $this->chart->barChart()
            ->setTitle('Total Pendapatan per Bulan')
            ->setColors(['#FFC107', '#D32F2F'])
            ->addData('Total Sales', array_column($salesData->toArray(), 'total_sales'))
            ->setXAxis(array_column($month->toArray(), 'month') );
    }
}
