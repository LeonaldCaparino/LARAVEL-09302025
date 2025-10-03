<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Job;
use App\Models\Tag;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create some companies
        Company::factory(8)->create();

        // Create tags
        $this->call(TagSeeder::class);

        // Create jobs (each job will also create a company via factory)
        Job::factory(30)->create()->each(function ($job) {
            // Attach random tags (1 to 3 per job)
            $tagIds = Tag::inRandomOrder()
                        ->take(rand(1, 3))
                        ->pluck('id');

            $job->tags()->attach($tagIds);
        });
    }
}