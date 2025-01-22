<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    use HasFactory;

    protected $table =

        'student_profiles';

    protected $fillable = [
        'name',
        'gender',
        'phone_number',
        'matric_number',
        'address',
        'age',

    ];
}
