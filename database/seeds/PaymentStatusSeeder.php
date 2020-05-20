<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_statuses')->insert([
            ['payment_status_name' => 'Invoiced', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['payment_status_name' => 'Paid', 'created_at' => Carbon::now()->format('Y-m-d H:i:s')]
        ]);
    }
}
