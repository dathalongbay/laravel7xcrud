<?php

namespace App\Models\Frontend;

use App\Models\Backend\ProductsModel;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Arg;

class CartModel extends Model
{
    //

    /**
     * An unique ID for the cart.
     *
     * @var string
     */
    protected $cartId;

    /**
     * Maximum item allowed in the cart.
     *
     * @var int
     */
    protected $cartMaxItem = 100;

    /**
     * Maximum quantity of a item allowed in the cart.
     *
     * @var int
     */
    protected $itemMaxQuantity = 200;

    /**
     * A collection of cart items.
     *
     * @var array
     */
    private $items = [];

    public function __construct(array $attributes = [],array $options = [])
    {
        if (isset($options['cartMaxItem']) && preg_match('/^\d+$/', $options['cartMaxItem'])) {
            $this->cartMaxItem = $options['cartMaxItem'];
        }

        if (isset($options['itemMaxQuantity']) && preg_match('/^\d+$/', $options['itemMaxQuantity'])) {
            $this->itemMaxQuantity = $options['itemMaxQuantity'];
        }

        $this->cartId = md5((isset($_SERVER['HTTP_HOST'])) ? $_SERVER['HTTP_HOST'] : 'SimpleCart') . '_cart';

        $this->read();

        parent::__construct($attributes);
    }


    public function read() {

        if (empty($this->items)) {
            $shoppingCart = session('shopping_cart', []);

            if ($shoppingCart) {
                $this->items = json_decode($shoppingCart, true);
            } else {
                $this->items = [];
            }


        }

    }

    public function write() {

        $shoppingCart = json_encode(array_filter($this->items));

        session(['shopping_cart' => $shoppingCart]);
    }




    public function getTotalItem()
    {
        $total = 0;

        foreach ($this->items as $items) {
            foreach ($items as $item) {
                ++$total;
            }
        }

        return $total;
    }


    /**
     * Get the total of item quantity in cart.
     *
     * @return int
     */
    public function getTotalQuantity()
    {

        $quantity = 0;
        foreach ($this->items as $items) {
            foreach ($items as $item) {

                $quantity += $item['quantity'];
            }
        }

        return $quantity;
    }


    public function getTotalPrice()
    {

        $total = 0;

        foreach ($this->items as $items) {
            foreach ($items as $item) {

                $total += $item['quantity']*$item['price'];
            }
        }

        return $total;
    }

    public function isItemExists($id, $attributes = [])
    {

        $attributes = (is_array($attributes)) ? array_filter($attributes) : [$attributes];

        if (isset($this->items[$id])) {
            $hash = md5(json_encode($attributes));
            foreach ($this->items[$id] as $item) {
                if ($item['hash'] == $hash) {
                    return true;
                }
            }
        }

        return false;
    }


    // xóa all sản phẩm khỏi giỏ hàng
    public function clearCart() {
        $this->items = [];

        session(['shopping_cart' => []]);
    }

    // xóa 1 sản phẩm khỏi giỏ hàng
    public function removeCart($id, $attributes = [])
    {
        if (!isset($this->items[$id])) {
            return false;
        }

        if (empty($attributes)) {
            unset($this->items[$id]);

            $this->write();

            return true;
        }
        $hash = md5(json_encode(array_filter($attributes)));

        foreach ($this->items[$id] as $index => $item) {
            if ($item['hash'] == $hash) {
                unset($this->items[$id][$index]);

                $this->write();

                return true;
            }
        }

        return false;
    }


    /**
     * Get items in  cart.
     *
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    public function addCart($id, $quantity = 1, $attributes = []) {

        $quantity = (preg_match('/^\d+$/', $quantity)) ? $quantity : 1;
        $attributes = (is_array($attributes)) ? array_filter($attributes) : [$attributes];
        $hash = md5(json_encode($attributes));

        if (count($this->items) >= $this->cartMaxItem && $this->cartMaxItem != 0) {
            return false;
        }

        if (isset($this->items[$id])) {
            foreach ($this->items[$id] as $index => $item) {
                if ($item['hash'] == $hash) {
                    $this->items[$id][$index]['quantity'] += $quantity;
                    $this->items[$id][$index]['quantity'] = ($this->itemMaxQuantity < $this->items[$id][$index]['quantity'] && $this->itemMaxQuantity != 0) ? $this->itemMaxQuantity : $this->items[$id][$index]['quantity'];

                    $this->write();

                    return true;
                }
            }
        }

        $product = ProductsModel::find($id);

        $this->items[$id][] = [
            'id'         => $id,
            'quantity'   => ($quantity > $this->itemMaxQuantity && $this->itemMaxQuantity != 0) ? $this->itemMaxQuantity : $quantity,
            'price' => $product->product_price,
            'hash'       => $hash,
            'attributes' => $attributes,
        ];

        $this->write();
    }






    /**
     * Update item quantity.
     *
     * @param string $id
     * @param int    $quantity
     * @param array  $attributes
     *
     * @return bool
     */
    public function updateCart($id, $quantity = 1, $attributes = [])
    {
        $quantity = (preg_match('/^\d+$/', $quantity)) ? $quantity : 1;

        if ($quantity == 0) {
            $this->remove($id, $attributes);

            return true;
        }

        if (isset($this->items[$id])) {
            $hash = md5(json_encode(array_filter($attributes)));

            foreach ($this->items[$id] as $index => $item) {
                if ($item['hash'] == $hash) {
                    $this->items[$id][$index]['quantity'] = $quantity;
                    $this->items[$id][$index]['quantity'] = ($this->itemMaxQuantity < $this->items[$id][$index]['quantity'] && $this->itemMaxQuantity != 0) ? $this->itemMaxQuantity : $this->items[$id][$index]['quantity'];

                    $this->write();

                    return true;
                }
            }
        }

        return false;
    }


}
