<?php

namespace App\Models;

use App\Filters\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'answer', 'question', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter(Builder $builder, QueryFilter $filter) {
        return $filter->apply($builder);
    }


}
