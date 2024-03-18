<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyStat extends Model
{
    use HasFactory;
    
    public function user() {
        return $this->belongsTo(User::class);
    }    

    public function customMetrics() {
    return $this->hasMany(CustomMetric::class);
    }


    protected $fillable = ['date', 'time', 'quality_score', 'diary', 'user_id', 'name', 'value']; 

}
