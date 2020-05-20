<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_status')->insert([
            ['order_status_name' => 'accepted',  'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['order_status_name' => 'processing',  'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['order_status_name' => 'delivered',  'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['order_status_name' => 'billed',  'created_at' => Carbon::now()->format('Y-m-d H:i:s')],
        ]);
    }
}
