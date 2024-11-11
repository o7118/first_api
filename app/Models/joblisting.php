<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class joblisting extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_title',
        'job_salary',
        'user_id'
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }


    
}
