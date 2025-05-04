<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlumniUserSurvey extends Model
{
    protected $fillable = [
        'name',
        'institution_type',
        'institution_name',
        'position',
        'email',
        'student_nim',
        'alumni_evaluation_id',
        'curriculum_suggestions',
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