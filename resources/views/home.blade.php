@extends('layout')

@section('content')
<h1 class="text-2xl font-bold mb-4">Job Listings</h1>

@foreach ($jobs as $job)
    <div class="mb-4 p-4 border rounded">
        <h2 class="text-xl font-semibold">{{ $job->title }}</h2>
        <p><strong>Company:</strong> {{ $job->company }}</p>
        <p><strong>Location:</strong> {{ $job->location }}</p>
        <p><strong>Salary:</strong> {{ $job->salary }}</p>
        <p class="mt-2">{{ $job->description }}</p>
    </div>
@endforeach
@endsection

