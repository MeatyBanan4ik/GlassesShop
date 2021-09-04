<?php


namespace App\Filters;


class UserFilter extends QueryFilter
{
    public function role($role = null){
        return $this->builder->when($role, function ($query) use($role) {
            $query->where('role', $role);
        });
    }

    public function search($search = ''){
        return $this->builder->when(!empty($search), function ($query) use($search) {
            $query->where('users.email', 'LIKE', '%'.$search.'%')->orWhere('users.number', 'LIKE', '%'.$search.'%')->orWhere('users.name', 'LIKE', '%'.$search.'%');
        });
    }

}
