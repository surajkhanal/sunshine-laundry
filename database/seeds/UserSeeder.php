<?php

use App\UserType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'user_name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin1234'),
            'user_type_id' => UserType::find(1)->first()->id,
            'user_status' => 1,
            'phone_number' => '123456789',
            'address' => '',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
