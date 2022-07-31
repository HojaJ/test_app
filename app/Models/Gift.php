<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'gift_box_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function gift_box() {
        return $this->belongsTo(Gift_box::class);
    }
}
