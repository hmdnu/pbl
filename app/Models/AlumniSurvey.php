<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class AlumniSurvey extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_nim',
        'profession_id',
        'phone',
        'email',
        'first_work_date',
        'waiting_period',
        'agency_type',
        'agency_name',
        'agency_location',
        'first_agency_work_date',
        'supervisor_name',
        'supervisor_position',
        'supervisor_email',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_nim');
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class, 'profession_id');
    }
}
