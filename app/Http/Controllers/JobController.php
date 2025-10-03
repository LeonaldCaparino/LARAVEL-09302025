<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Company;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobsController extends Controller
{
    public function __construct()
    {
        // Require auth for create/store/edit/update/destroy
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $query = Job::with(['company', 'tags', 'user'])->latest();

        if ($q = $request->query('q')) {
            $query->where(function ($qBuilder) use ($q) {
                $qBuilder->where('title', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%")
                    ->orWhere('location', 'like', "%{$q}%");
            });
        }

        if ($tag = $request->query('tag')) {
            $query->whereHas('tags', function ($b) use ($tag) {
                $b->where('name', $tag);
            });
        }

        $jobs = $query->paginate(8)->withQueryString();
        $tags = Tag::all();

        return view('jobs.index', compact('jobs', 'tags'));
    }

    public function create()
    {
        $companies = Company::all();
        $tags = Tag::all();

        return view('jobs.create', compact('companies', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'company_id'   => 'nullable|exists:companies,id',
            'company_name' => 'nullable|string|max:255',
            'location'     => 'nullable|string|max:255',
            'salary'       => 'nullable|string|max:100',
            'description'  => 'required|string',
            'logo'         => 'nullable|image|max:2048',
            'tags'         => 'nullable|array',
        ]);

        // Company: either chosen or create new
        if (empty($validated['company_id']) && !empty($validated['company_name'])) {
            $company = Company::firstOrCreate(['name' => $validated['company_name']]);
        } else {
            $company = Company::find($validated['company_id']);
        }

        // Create Job
        $job = new Job();
        $job->user_id     = Auth::id();
        $job->company_id  = $company?->id;
        $job->title       = $validated['title'];
        $job->location    = $validated['location'] ?? null;
        $job->salary      = $validated['salary'] ?? null;
        $job->description = $validated['description'];

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $job->logo_path = $path;
        }

        $job->save();

        // Attach tags
        if (!empty($validated['tags'])) {
            $job->tags()->sync($validated['tags']);
        }

        return redirect()
            ->route('jobs.index')
            ->with('success', 'Job created successfully.');
    }
}
