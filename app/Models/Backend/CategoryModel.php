<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    //

    // khai báo tên bảng
    protected $table = 'category';

    // khai báo khóa chính của bảng
    protected $primaryKey = 'id';

    public function products()
    {
        return $this->hasMany('App\Models\Backend\ProductsModel', 'category_id');
    }
}
