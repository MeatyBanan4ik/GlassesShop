<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Lens extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'product_id',
        'purpose',
        'diameter',
        'center_thickness',
        'material_type',
        'is_uv',
        'moisture',
        'lens_material',
        'lens_material',
        'oxygen_transmission',
        'wearing_mode',
        'replacement_mode',
        'tinting',
        'diopters',
        'curvature',
        'cylinder',
        'axis'
    ];

    protected $table = 'lenses';

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }


}
