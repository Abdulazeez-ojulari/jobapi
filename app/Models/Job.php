<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'job_title', 
        'company_name', 
        'location', 
        'job_types', 
        'salary_range', 
        'submission_deadline', 
        'job_sector'
    ];

    public function jobs(){
        return $this->hasMany(Job::class);
    }
}
