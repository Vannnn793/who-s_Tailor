<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TailorPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'path'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
