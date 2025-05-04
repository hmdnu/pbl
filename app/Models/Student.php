<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $primaryKey = 'nim';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nim',
        'name',
        'graduation_date',
        'program_study_date',
        'program_study_id',
        'has_filled_survey',
    ];

    public function programStudy()
    {
        return $this->belongsTo(ProgramStudy::class, 'program_study_id');
    }

    public function alumniSurvey()
    {
        return $this->hasOne(AlumniSurvey::class, 'student_nim');
    }

    public function alumniUserSurvey()
    {
        return $this->hasOne(AlumniUserSurvey::class, 'student_nim');
    }
}
