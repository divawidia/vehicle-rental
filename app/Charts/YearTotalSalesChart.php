<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class YearTotalSalesChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $salesData = DB::table('bookings')->select(DB::raw('SUM(total_price) as total_sales'))->where('transaction_status', 'Sudah Dibayar')->groupBy(DB::raw('YEAR(pick_up_date)'))->get();
        $year = DB::table('bookings')->select(DB::raw('YEAR(pick_up_date) as year'))->where('transaction_status', 'Sudah Dibayar')->groupBy(DB::raw('YEAR(pick_up_date)'))->get();
//        dd(array_column($month->toArray(), 'month'));
        return $this->chart->barChart()
            ->setTitle('Total Pendapatan per Tahun')
            ->setColors(['#FFC107', '#D32F2F'])
            ->addData('Total Sales', array_column($salesData->toArray(), 'total_sales'))
            ->setXAxis(array_column($year->toArray(), 'year') );
    }
}
