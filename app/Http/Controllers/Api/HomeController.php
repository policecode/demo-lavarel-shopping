<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
class HomeController extends Controller
{
    public function index() {
        try {
            $listCategory = Product::offset(0)->limit(10)->get();
            $status = 'success';
            $data = [
                'status' => 'success',
                'data' => $listCategory
            ];
        } catch (\Throwable $th) {
            $data = [
                'status' => 'error',
                'message' => $th->getMessage(),
            ];

        }
        // dd($listCategory);
        return $data;
    }
}
