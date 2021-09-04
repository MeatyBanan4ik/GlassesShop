<?php


namespace App\Filters;


class AllQuestionFilter extends QueryFilter
{
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

    public function search($search = ''){
        return $this->builder->where('answer', 'LIKE', '%'.$search.'%')->orWhere('question', 'LIKE', '%'.$search.'%');
    }

}
