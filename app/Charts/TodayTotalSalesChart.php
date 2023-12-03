<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class TodayTotalSalesChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $salesData = DB::table('bookings')->select(DB::raw('SUM(total_price) as total_sales'))->where('transaction_status', 'Sudah Dibayar')->where(DB::raw('DATE(created_at)'), DB::raw('CURRENT_DATE()'))->groupBy(DB::raw('WEEKOFYEAR(pick_up_datetime)'))->get();

        return $this->chart->barChart()
            ->setTitle('Total Pendapatan per Hari Ini')
            ->setColors(['#FFC107', '#D32F2F'])
            ->addData('Total Sales', array_column($salesData->toArray(), 'total_sales'))
            ->setXAxis(['Today']);
    }
}
