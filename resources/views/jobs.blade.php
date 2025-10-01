<x-layout>
    <x-slot:heading>
        Job Listing
    </x-slot:heading>

    <ul>
        @foreach ($jobs as $job)
            <li>
                <a href="/jobs/{{ $job['id'] }}" class="text-red-500 hover:underline">
                    {{ $job['title'] }}:</strong> Pays {{ $job['salary'] }} per month.
            </li>
        @endforeach
    </ul>
</x-layout>
