<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;
    protected $fillable = ['name','calories_per_100g'];

    public function foodLogs()
    {
        return $this->hasMany(FoodLog::class);
    }

}
