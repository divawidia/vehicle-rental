<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class WeekTotalSalesChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $salesData = DB::table('bookings')->select(DB::raw('SUM(total_price) as total_sales'))->where('transaction_status', 'Sudah Dibayar')->groupBy(DB::raw('WEEKOFYEAR(pick_up_datetime)'))->get();
        $week = DB::table('bookings')->select(DB::raw('WEEKOFYEAR(pick_up_datetime) as week'))->where('transaction_status', 'Sudah Dibayar')->groupBy(DB::raw('WEEKOFYEAR(pick_up_datetime)'))->get();
//        dd(array_column($month->toArray(), 'month'));
        return $this->chart->barChart()
            ->setTitle('Total Pendapatan per Minggu')
            ->setColors(['#FFC107', '#D32F2F'])
            ->addData('Total Sales', array_column($salesData->toArray(), 'total_sales'))
            ->setXAxis(array_column($week->toArray(), 'week') );
    }
}
