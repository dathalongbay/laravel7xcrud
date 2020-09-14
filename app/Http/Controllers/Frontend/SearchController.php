<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\ProductsModel;
use App\Models\Frontend\CartModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
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

    public function search(Request $request) {

        $this->shareKey();

        $products = [];
        $keyword = $request->get("keyword", "");
        $keyword = strip_tags($keyword);
        if (strlen($keyword) > 3 && strlen($keyword) < 100) {

            $queryORM = ProductsModel::where('product_name', "LIKE", "%".$keyword."%");

            $products = $queryORM->paginate(10);
        }
        $data["keyword"] = $keyword;
        $data["products"] = $products;

        $categories = DB::table("category")->get();
        $data["categories"] = $categories;
        return view("site.search", $data);
    }
}
