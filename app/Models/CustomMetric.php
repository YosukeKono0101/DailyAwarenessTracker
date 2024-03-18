<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomMetric extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dailyStat()
    {
        return $this->belongsTo(DailyStat::class);
    }

    protected $fillable = ['daily_stat_id', 'user_id', 'name', 'value'];

}
