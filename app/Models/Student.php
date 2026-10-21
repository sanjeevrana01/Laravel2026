<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Course;

class Student extends Model
{
    protected $fillable = [
        'name',
        'email',
        'age',
        'course_id',
    ];

    protected function casts(): array
    {
        return [
            'age' => 'integer',
        ];
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
