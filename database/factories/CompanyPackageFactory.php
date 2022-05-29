<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Package;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyPackage>
 */
class CompanyPackageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $package = Package::all()->random();
        $start = $this->faker->dateTimeBetween('-2 years','now',null);

        if($package->type == "monthly"){
            $end = Carbon::parse($start)->addMonth($package->period);
        }else{
            $end = Carbon::parse($start)->addYears($package->period);
        }

        return [
            'company_id' => Company::factory(),
            'package_id' => $package->id,
            'start_date' => $start,
            'end_date' => $end,
            'status' => !($end < date('Y-m-d H:i:s'))
        ];
    }
}
