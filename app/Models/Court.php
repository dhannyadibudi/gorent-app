<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Court extends Model
{
    use HasFactory;
    use HasUuid;
    use SoftDeletes;

    protected $fillable = [
        'gor_id',
        'name',
        'price_per_hour',
        'open_time',
        'close_time',
        'is_active',
    ];

    protected $casts = [
        'price_per_hour' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function gor()
    {
        return $this->belongsTo(Gor::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}