<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class Course extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
    ];
    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
