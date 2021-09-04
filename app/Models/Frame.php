<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Frame extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'product_id',
        'sex',
        'frame_shape',
        'frame_material',
        'bridge_size',
        'eyepiece_size',
        'temple_length',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
