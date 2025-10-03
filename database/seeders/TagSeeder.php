<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            'php',
            'laravel',
            'javascript',
            'remote',
            'full-time',
            'part-time',
            'senior',
            'junior',
        ];

        foreach ($tags as $t) {
            Tag::firstOrCreate(['name' => $t]);
        }
    }
}