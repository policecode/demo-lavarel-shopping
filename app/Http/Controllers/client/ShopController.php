<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    private $product;
    public function __construct()
    {
        $this->product = new Product();

    }
    Public function getShopping(Request $request) {
        $page = 1;
        if (!empty($request->_page)) {
            $page = $request->_page;
        }
        $ArrCategory = $this->product->getAllProduct($page);
        $data = [
            'title' => 'Cửa hàng',
            'active' => 'shop',
            'getAllProduct' => $ArrCategory['getAllProduct'],
            'pagination' => handleRenderPagination($ArrCategory['currentPage'], $ArrCategory['pageNumber']),
            'queryArr' => $request->query(),
           
        ];
        if ($request->session()->has('msg')) {
            $data['msg'] = $request->session()->pull('mug');
        }
        return view('page.client.shopping', $data);

    }
}
