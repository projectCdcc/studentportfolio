<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'city',
        'country',
        'job_type',
        'category',
        'requirement',
        'how_to',
        'description',
        'company',
    ];

}
