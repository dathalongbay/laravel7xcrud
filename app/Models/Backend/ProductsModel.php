<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;
use App\Models\Backend\CategoryModel;

class ProductsModel extends Model
{
    //

    // khai báo tên bảng
    protected $table = 'products';

    // khai báo khóa chính của bảng
    protected $primaryKey = 'id';

    public function category()
    {
        return $this->belongsTo('App\Models\Backend\CategoryModel', 'category_id');
    }

}
