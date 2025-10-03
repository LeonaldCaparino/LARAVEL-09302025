<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    protected $model = Company::class;

    public function definition(): array
    {
        return [
            'name'    => $this->faker->company(),
            'website' => 'https://' . $this->faker->domainName(),
            'logo_path' => null, // optional kung gusto mo default value
        ];
    }
}