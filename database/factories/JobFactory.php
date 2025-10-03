<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    protected $model = Job::class;

    public function definition(): array
    {
        return [
            'company_id'  => Company::factory(),
            'title'       => $this->faker->jobTitle(),
            'location'    => $this->faker->city(),
            'salary'      => '$' . $this->faker->numberBetween(30000, 150000),
            'description' => $this->faker->paragraphs(3, true),
        ];
    }
}
