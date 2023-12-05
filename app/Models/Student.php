<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    
    
     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'graduate_date',
        'about_me',
        'user_id',
    ];


    // Database table relationship 
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function cv()
    {
        return $this->hasOne(Cv::class, 'student_id');
    }
}
