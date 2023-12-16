<?php

namespace App\Console\Commands;

use App\Models\Promo;
use Carbon\Carbon;
use Illuminate\Console\Command;

class StartSaleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'start:sale';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sales = Promo::where('type', 'sale')->get();

        foreach ($sales as $sale){
            $start_time = Carbon::parse($sale->starts_at);

            if (!is_null($start_time) && $start_time->isCurrentMinute() && $sale->status == '0'){
                $sale->update([
                    'status' => '1'
                ]);

            }
        }
    }
}
