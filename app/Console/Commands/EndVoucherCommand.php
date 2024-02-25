<?php

namespace App\Console\Commands;

use App\Models\Promo;
use Carbon\Carbon;
use Illuminate\Console\Command;

class EndVoucherCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'end:voucher';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'End Current Running Voucher';

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
            $end_time = Carbon::parse($voucher->expires_at);

            if (!is_null($end_time) && $end_time->isCurrentMinute() && $voucher->status == '1'){
                $voucher->update([
                    'status' => '0'
                ]);
            }
        }
    }
}
