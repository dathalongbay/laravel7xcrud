<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class OrderDetailModel extends Model
{
    //

    // khai báo tên bảng
    protected $table = 'orderdetail';

    // khai báo khóa chính của bảng
    protected $primaryKey = 'id';
}
