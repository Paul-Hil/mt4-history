<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TradeClose extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'trades_close';
    protected $fillable = ['openTime', 'closeTime', 'day_id', 'profit', 'type', 'levier'];

    public function day() {
        return $this->belongsTo(Day::class);
    }
}
