<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Shift extends Model
{
    use HasFactory;
    protected $fillable = [
        'start_time',
        'end_time',
        'position',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(Shift_user::class);
    }
}
