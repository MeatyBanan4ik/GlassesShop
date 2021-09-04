<?php


namespace App\Filters;


class ProductsFilter extends QueryFilter
{
    public function category($category = null){
        return $this->builder->when($category, function ($query) use($category) {
            $query->where('category', $category);
        });
    }

    public function search($search = ''){
        return $this->builder->when(!empty($search), function ($query) use($search) {
            $query->where('vendor_code', 'LIKE', '%'.$search.'%')->orWhere('brand', 'LIKE', '%'.$search.'%')->orWhere('name', 'LIKE', '%'.$search.'%');
        });
    }

}
