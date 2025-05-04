<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'name',
    ];

    public function professionCategory()
    {
        return $this->belongsTo(ProfessionCategory::class, 'categroy_id');
    }

    public function alumniSurvey()
    {
        return $this->hasMany(AlumniSurvey::class, 'profession_id');
    }
}