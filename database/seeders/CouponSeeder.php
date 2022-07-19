<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Coupon::create([
            'code'              => 'wolf',
            'type'              => 'fixed',
            'value'             => 200,
            'description'       => 'Discount 200 LE on your sales on website',
            'use_times'         => 20,
            'start_date'        => Carbon::now(),
            'expire_date'       => Carbon::now()->addMonth(),
            'greater_than'      => 600,
            'status'            => 1,
        ]);

        Coupon::create([
            'code'              => 'wolfwolf',
            'type'              => 'percentage',
            'value'             => 50,
            'description'       => 'Discount 50% on your sales on website',
            'use_times'         => 5,
            'start_date'        => Carbon::now(),
            'expire_date'       => Carbon::now()->addWeek(),
            'greater_than'      => null,
            'status'            => 1,
        ]);
        Coupon::create([
            'code'              => 'zzzz',
            'type'              => 'fixed',
            'value'             => 100,
            'description'       => 'العيد الكبير',
            'use_times'         => 5,
            'start_date'        => Carbon::now(),
            'expire_date'       => Carbon::now()->addWeek(),
            'greater_than'      => 1000,
            'status'            => 1,
        ]);
    }
}
