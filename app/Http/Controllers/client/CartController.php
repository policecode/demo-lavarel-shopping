<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Trait\Cart;
use App\Models\Product;


class CartController extends Controller
{
    private $cart;
    private $product;
    public function __construct()
    {
        $this->product = new Product();
        $this->cart = new Cart();
    }

    public function getFormCart(Request $request) {
        $cartList = $this->cart->getAllCart();
    
        $data = [
            'title' => 'Giỏ hàng',
            'active' => 'cart',
            'cartList' => $cartList
        ];
        return view('page.client.cart', $data);
    }

    public function addProduct(Request $request) {
        $product = $this->product->getIdProduct($request->product_id);
        try {
            if ($product) {
                $this->cart->addCart([
                    'id' => $request->product_id,
                    'name' => $product->name,
                    'qty' => 1,
                    'price' => $product->price,
                    'options' => [
                        'image' => $product->feature_image_path
                    ]
                ]);
                 $dataJson = [
                     'status' => 'success'
                 ];
            }
        } catch (\Throwable $th) {
            $dataJson = [
                'status' => 'error',
            ];
        }
        $respone = response()
        ->json($dataJson)
        ->header('Content-Type', 'application/json');
        return $respone;
    }

    public function addProductToCart($id){
        try {
            $product = $this->product->getIdProduct($id);
            if ($product) {
                $this->cart->addCart([
                    'id' => $id,
                    'name' => $product->name,
                    'qty' => 1,
                    'price' => $product->price,
                    'options' => [
                        'image' => $product->feature_image_path
                    ]
                ]);
            }
        } catch (\Throwable $th) {
           dd($th);
        }

        return redirect()->route('cart.home');
    }
// API
    public function updateProduct(Request $request, $index) {
        try {
            $this->cart->updateCart($index, $request->all());
            $data = [
                'status' => 'success',
            ];
        } catch (\Throwable $th) {
            $data = [
                'status' => 'error',
            ];
        }
        $respone = response()
        ->json($data)
        ->header('Content-Type', 'application/json');
        return $respone;
    }
// API
    public function deleteProduct($index) {
        try {
            $this->cart->deleteCart($index);
            $data = ['status' => 'success'];
        } catch (\Throwable $th) {
            $data = ['status' => 'error'];
        }

        $respone = response()
        ->json($data)
        ->header('Content-Type', 'application/json');
        return $respone;
    }
// API
    public function getBildCart() {
        try {
            $allCart = $this->cart->getAllCart();
            $totalPrice = $this->cart->totalPrice();
            $data = [
                'status' => 'success',
                'allCart' => $allCart,
                'totalPrice' => $totalPrice,
            ];
        } catch (\Throwable $th) {
            $data = [
                'status' => 'error',
            ];
        }
        $respone = response()
        ->json($data)
        ->header('Content-Type', 'application/json');
        return $respone;
    }

   
}
