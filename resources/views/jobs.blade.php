@extends('layout')

@section('content')
<h1 class="text-2xl font-bold mb-4">Job Listings</h1>

<a href="{{ route('jobs.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Job</a>

@if(session('success'))
    <p class="mt-4 text-green-600">{{ session('success') }}</p>
@endif

@foreach ($jobs as $job)
    <div class="mb-4 p-4 border rounded">
        <h2 class="text-xl font-semibold">
            <a href="{{ route('jobs.show', $job) }}">{{ $job->title }}</a>
        </h2>
        <p><strong>Company:</strong> {{ $job->company }}</p>
        <p><strong>Location:</strong> {{ $job->location }}</p>
        <p><strong>Salary:</strong> {{ $job->salary }}</p>
        <a href="{{ route('jobs.edit', $job) }}" class="text-blue-500">Edit</a>
        <form action="{{ route('jobs.destroy', $job) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-500 ml-2">Delete</button>
        </form>
    </div>
@endforeach

@endsection
