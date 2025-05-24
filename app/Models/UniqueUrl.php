<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniqueUrl extends Model
{
    protected $fillable = ['nim', 'role', 'unique_code', 'email', 'is_submitted'];

}