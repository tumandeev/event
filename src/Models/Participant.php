<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property string $ip
 * @property string $date
 * @property int $result
 */
class Participant extends Model
{
    protected $fillable = [
        'date',
        'ip',
        'result'
    ];

    protected $dates = [
        'date'
    ];

    public $timestamps = false;
    public function scopeGetParticipant($query)
    {
        $query->where('ip', $_SERVER['REMOTE_ADDR'])->where('date', Carbon::now()->format('y-m-d'));
    }

    public function scopeGetWinnerToday($query)
    {
        $query->where('result', true)->where('date', Carbon::now()->format('y-m-d'));
    }

}