<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class AlumniEvaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_nim',
        'teamwork',
        'it_expertise',
        'foreign_language',
        'communication',
        'self_development',
        'leadership',
        'work_ethic',
        'unmet_competencies',
    ];

    public function alumniUserSurvey()
    {
        return $this->hasOne(AlumniUserSurvey::class, 'alumni_evaluation_id');
    }
}
