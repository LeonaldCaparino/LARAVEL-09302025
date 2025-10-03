<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;
use App\Http\Controllers\JobController;

Route::resource('jobs', JobController::class);

Route::get('/', function () {
    $jobs = Job::latest()->get();
    return view('home', ['jobs' => $jobs]);
});

Route::get('/jobs', function () {
    return view('jobs', [
        'jobs'=> Job::all()
    ]);   
});

Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);
    abort_if(!$job, 404);

    return view('job', ['job' => $job]);
});

Route::get('/contact', function () {
     return view('contact');
});