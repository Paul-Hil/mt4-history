<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Trade extends Model
{
    use HasFactory;
    protected $fillable = ['dateTime', 'day_id', 'profit', 'type', 'levier'];

    public function day() {
        return $this->belongsTo(Day::class);
    }
}
