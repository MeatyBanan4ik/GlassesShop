<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Glasses extends Model
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
        'lens_color',
        'polarization',
        'mirror',
        'gradient',
        'lens_material'
    ];
    protected $table = 'glasses';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
