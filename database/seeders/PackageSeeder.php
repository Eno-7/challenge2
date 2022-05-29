<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Package::insert([
             [
            'type' => 'monthly',
            'name' => 'Package 1',
            'period' => 1,
            'price' => 100
        ],[
             'type' => 'monthly',
             'name' => 'Package 2',
             'period' => 3,
             'price' => 250
         ],[
             'type' => 'yearly',
             'name' => 'Package 3',
             'period' => 1,
             'price' => 800
         ]
         ]);


    }
}
