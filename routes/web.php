<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;

Route::get('/jobs', function () {
    return view('jobs', [
        'jobs' => Job::all()
    ]);
});

Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);

    abort_if(!$job, 404);

    return view('job', ['job' => $job]);
});