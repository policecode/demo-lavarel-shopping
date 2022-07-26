<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
class HomeClientController extends Controller
{
    private $product;
    public function __construct()
    {
        $this->product = new Product();
    }
    public function index()
    {
        $listCategory = $this->product->getLimit();
        $popuralproduct = $this->product->getLimit();
        // dd($listCategory);
        $data = [
            'title' => 'Trang chủ',
            'listCategory' => $listCategory,
            'popuralproduct' => $popuralproduct
        ];
        return view('page.client.home', $data);
    }
}
