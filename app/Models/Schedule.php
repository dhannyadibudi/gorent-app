<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;
    use HasUuid;
    use SoftDeletes;

    protected $fillable = [
        'court_id',
        'schedule_date',
        'start_time',
        'end_time',
        'is_booked',
    ];

    protected $casts = [
        'schedule_date' => 'date',
        'is_booked' => 'boolean',
    ];

    public function court()
    {
        return $this->belongsTo(Court::class);
    }
    
    public function booking()
    {
        return $this->hasOne(Booking::class);
    }
}