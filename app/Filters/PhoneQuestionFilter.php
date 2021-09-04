<?php


namespace App\Filters;


class PhoneQuestionFilter extends QueryFilter
{
    public function number($search = ''){
            return $this->builder->when($search, function ($query) use($search){
                $query->where('number', 'LIKE', '%'.$search.'%');
            });
    }

    public function status($status = null){
        return $this->builder->when($status, function ($query) use($status){
           if($status == 'wait'){
                $query->where('user_id', '=', null);
           }
           else{
                $query->whereNotNull('user_id');
           }
        });
    }

}
