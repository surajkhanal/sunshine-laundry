<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->insert([
            [
                'service_name' => 'Regular Washing',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'service_name' => 'Dry Cleaning',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ]);
    }
}
