<?php

namespace App\Models;

use Illuminate\Support\Arr;

class Job {
    public static function all(): array 
    {
        return [
            [
                'id' => 1,
                'title' => 'CEO',
                'salary' => '$80,000',
            ],
            [
                'id' => 2,
                'title' => 'Choreographer',
                'salary' => '$60,000',
            ],
            [
                'id' => 3,
                'title' => 'Artist',
                'salary' => '$50,000',
            ],
        ];
    }

    public static function find(int $id): ?array
    {
        return Arr::first(static::all(), fn($job) => $job['id'] == $id);
    }
}