<?php

namespace App\Console\Commands;

use App\Models\Promo;
use Carbon\Carbon;
use Illuminate\Console\Command;

class StartVoucherCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'start:voucher';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start Scheduled Voucher';


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $vouchers = Promo::where('type', 'voucher')->get();

        foreach ($vouchers as $voucher){
            $start_time = Carbon::parse($voucher->starts_at);

            if (!is_null($start_time) && $start_time->isCurrentMinute() && $voucher->status == '0'){
                $voucher->update([
                    'status' => '1'
                ]);
            }
        }
    }
}
