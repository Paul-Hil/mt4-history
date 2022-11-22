<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['date', 'label', 'profit', 'commission', 'profit_total'];

    public function trade() {
        return $this->hasMany(Trade::class);
    }
}
