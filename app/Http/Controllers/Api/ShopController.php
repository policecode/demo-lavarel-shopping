<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        try {
            if (!empty($request->keyword)) {
                $ArrCategory = Product::where('name', 'like', '%'.$request->keyword.'%')->paginate(15);
            } else {
                $ArrCategory = Product::paginate(15);
            }
            $data = [
                'status' => 'success',
                'getAllProduct' => $ArrCategory,
            ];
        } catch (\Throwable $th) {
            $data = [
                'status' => 'error',
                'message' => $th->getMessage(),
            ];
        }

        return $data;
    }
}
