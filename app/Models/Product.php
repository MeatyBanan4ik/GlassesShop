<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'title',
        'description',
        'price',
        'brand',
        'in_stock',
        'category',
        'img',
        'vendor_code'
    ];

    public function comm()
    {
        return $this->hasMany('App\Models\Commentary');
    }

    public function lens()
    {
        return $this->hasOne('App\Models\Lens');
    }

    public function glasses()
    {
        return $this->hasOne(Glasses::class);
    }

    public function frame()
    {
        return $this->hasOne(Frame::class);
    }

    public function orders() {
        return $this->belongsToMany(Order::class);
    }

    public static function getOrderProductInfo($orderID) {
        return DB::select('SELECT * FROM order_product WHERE order_id = ?', [$orderID]);
    }

    public function scopeFilter(Builder $builder, QueryFilter $filter) {
        return $filter->apply($builder);
    }
}
