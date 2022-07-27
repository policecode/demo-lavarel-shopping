<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    
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

        return view('page.client.shopping', $data);

    }
}
