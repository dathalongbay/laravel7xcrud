<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    //

    public function index() {

        $data = [];

        $data["countProducts"] = $countProducts = DB::table('products')->count();
        $data["countCategories"] = $countCategories = DB::table('category')->count();
        $data["countOrders"] = $countOrders = DB::table('orders')->count();
        $data["countAdmins"] = $countAdmins = DB::table('admins')->count();

        return view("backend.dashboard.home", $data);
    }
}
