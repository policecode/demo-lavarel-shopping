<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// session
use App\Models\Product;

class CartController extends Controller
{
    public function __construct(){
    }

    public function index(Request $request) {
        try {
            $listProduct = $request->query()['cartProduct'];
            $dataProduct = Product::select('id', 'name', 'price', 'feature_image_path');
            foreach ($listProduct as $value) {
                $dataProduct = $dataProduct->orWhere('id', '=',  $value);
            }
            $dataProduct = $dataProduct->get();
        } catch (\Throwable $th) {
            dd($th);
        }
        $data = [
            'status' => 'success',
            'cartList' => $dataProduct,
        ];
        return $data;
    }

    public function add(Request $request) {
        dd($request->input());

        try {
            $product = Product::find($request->product_id);
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
                $data = [
                    'status' => 'success',
                    'count' => $this->cart->getCount()
                ];
            } else {
                $data = [
                    'status' => 'warning',
                    'message' => 'Sản phẩm không tồn tại trong hệ thống',
                ];
            }
        } catch (\Throwable $th) {
            $data = [
                'status' => 'error',
                'message' => $th->getMessage(),
            ];
        }
        return $data;
    }

   
}
