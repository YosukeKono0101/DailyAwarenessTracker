<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomMetricType extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customMetrics()
    {
        return $this->hasMany(CustomMetric::class);
    }
}
