<?php


namespace App\Filters;


class OrderFilter extends QueryFilter
{
    public function status($status = null){
        return $this->builder->when($status, function ($query) use($status) {
            $query->where('status', $status);
        });
    }

    public function payment($payment = null){
        return $this->builder->when($payment, function ($query) use($payment) {
            $query->where('payment', $payment);
        });
    }

    public function search($search = ''){
        return $this->builder->when(!empty($search), function ($query) use($search) {
            $query->join('users', 'users.id', '=', 'orders.user_id')->where('users.email', 'LIKE', '%'.$search.'%')->orWhere('users.number', 'LIKE', '%'.$search.'%')->orWhere('users.name', 'LIKE', '%'.$search.'%');
        });
    }

}
