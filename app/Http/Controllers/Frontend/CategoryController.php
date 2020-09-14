<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\ProductsModel;

use App\Models\Frontend\CartModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    //

    public function shareKey()
    {
        $cart = new CartModel();
        $totalQttCart = $cart->getTotalQuantity();
        $totalPriceCart = $cart->getTotalPrice();
        view()->share('totalQttCart', $totalQttCart);
        view()->share('totalPriceCart', $totalPriceCart);
    }

    public function index($id) {

        $this->shareKey();

        $category = DB::table("category")->where("id", "=", $id)->first();
        $categories = DB::table("category")->get();
        $discountProducts = ProductsModel::where("category_id", "=", $id)->orderBy("product_price")->limit(10)->get();
        $products = ProductsModel::where("category_id", "=", $id)->paginate(10);

        $data = [];
        $data["categories"] = $categories;
        $data["category"] = $category;
        $data["discountProducts"] = $discountProducts;
        $data["products"] = $products;

        return view("site.category", $data);
    }
}
