<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job::all();

class JobSeeder extends Seeder
{
    public function run(): void
    {
        Job::create(['title' => 'CEO', 'salary' => '$80,000']);
        Job::create(['title' => 'Choreographer', 'salary' => '$60,000']);
        Job::create(['title' => 'Artist', 'salary' => '$50,000']);
    }
}