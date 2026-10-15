<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'email',
        'age',
    ];

    protected function casts(): array
    {
        return [
            'age' => 'integer',
        ];
    }
}
