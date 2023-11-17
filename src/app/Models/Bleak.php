<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bleak extends Model
{
    use HasFactory;
    protected $fillable = [
        'work_id',
        'start_time',
        'end_time',
    ];

    //リレーション
    public function work()
    {
        return $this->belongsTo(Work::class);
    }
}
