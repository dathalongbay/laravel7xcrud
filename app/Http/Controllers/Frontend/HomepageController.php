<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\CartModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomepageController extends Controller
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

    public function index() {

        $this->shareKey();

        $categories = DB::table("category")->get();

        //dd($categories);

        $data = [
            "categories" => $categories
        ];

        $products = [];

        foreach ($categories as $category) {

            $productsInCat = DB::table("products")->where("category_id",$category->id)->limit(2)->orderBy("product_price")->get();
            foreach($productsInCat as $product) {
                $products[] = $product;
            }
        }

        $data["products"] = $products;

        return view("site.homepage", $data);
    }
}
