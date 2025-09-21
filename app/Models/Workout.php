<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','name','calories_burned'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
