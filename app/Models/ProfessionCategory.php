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
        return $this->hasMany(Profession::class, 'category_id');
    }
}