<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class AlumniUserSurvey extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'institution_type',
        'institution_name',
        'institution_location',
        'institution_scale',
        'position',
        'email',
        'student_nim',
        'alumni_evaluation_id',
        'curriculum_suggestion',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_nim');
    }

    public function alumniEvaluation()
    {
        return $this->hasOne(AlumniEvaluation::class, 'alumni_evaluation_id');
    }
}
