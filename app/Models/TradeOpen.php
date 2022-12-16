<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TradeOpen extends Model
{
    use HasFactory;
    protected $table = 'trades_open';
    public $timestamps = false;
    protected $fillable = ['openTime', 'profit', 'type', 'levier', 'price'];

}
