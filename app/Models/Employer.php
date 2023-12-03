<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'organization_name',
        'email',
        'org_type',
        'street',
        'city',
        'establish_year',
        'country',
        'about',
        'phone',
        'website',
        'user_id',
    ];

    // relationship
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
