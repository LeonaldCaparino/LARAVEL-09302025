<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id',
        'title',
        'location',
        'salary',
        'description',
        'logo_path',
    ];

    /**
     * A job belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A job belongs to a company.
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * A job may have many tags.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}