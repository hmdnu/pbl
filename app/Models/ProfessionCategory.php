<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];

    public function profession()
    {
        return $this->hasMany(Profession::class, 'profession_id');
    }

    public function professionCategory()
    {
        return $this->hasMany(ProfessionCategory::class, 'profession_category_id');
    }
}