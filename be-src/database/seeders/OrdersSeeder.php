<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Factory::create();

        $cities = ["Lviv", "Kyiv", "Dnipro", "Kharkiv", "Poltava"];
        $streets = ["Shevchenko", "Heroiv Krut", "Mazepa", "Bandera", "Khmel", "Ukrainka"];
        $statuses = ["ordered", "called", "delivered", "cancelled"];

        for ($i = 0; $i <= 500; $i++) {
            DB::table('orders')->insert([
                'userId'        => mt_rand(1, 100),
                'city'          => $cities[mt_rand(0, count($cities)-1)],
                'street'        => $streets[mt_rand(0, count($streets)-1)],
                'status'        => $statuses[mt_rand(0, count($statuses)-1)],
                'building'      => $faker->numberBetween(1, 999),
                'apartment'     => $faker->numberBetween(1, 999),
                'paidInAdvance' => $faker->boolean,
                'totalPrice'    => $faker->numberBetween(1, 100),
                'date'          => $faker->dateTimeBetween('-3 months', 'today'),
            ]);
        }
    }
}
