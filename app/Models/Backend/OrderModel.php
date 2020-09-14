<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    //
    // khai báo tên bảng
    protected $table = 'orders';

    // khai báo khóa chính của bảng
    protected $primaryKey = 'id';
}
