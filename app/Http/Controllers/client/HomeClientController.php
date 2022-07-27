<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 

use App\Models\Product;
use App\Models\ReceivEmail;
class HomeClientController extends Controller
{
    private $product;
    private $receivEmail;
    public function __construct()
    {
        $this->product = new Product();
        $this->receivEmail = new ReceivEmail();

    }
    public function index() {
        $listCategory = $this->product->getLimit();
        $popuralproduct = $this->product->getLimit();
        // dd($listCategory);
        $data = [
            'title' => 'Trang chủ',
            'active' => 'home',
            'listCategory' => $listCategory,
            'popuralproduct' => $popuralproduct
        ];
        return view('page.client.home', $data);
    }

    public function signUpFor(Request $request) {
        $rules = [
            'email' => ['required', 'email', 'unique:receiv_emails,email'],
        ];
        $messages = [
            'required' => ':attribute bắt buộc phải nhập',
            'email' => ':attribute không đúng định dạng vd: nguyenvana@gmail.com',
            'unique' => ':attribute đã được đăng ký trong hệ thông',
        ];
        $attributes = [
            'email' => 'Địa chỉ email',
        ];
        $validator = Validator::make($request->all(), $rules, $messages, $attributes);
        if ($validator->fails()) {
            $dataResponse = [
                'status' => 'errors',
                'errors' => $validator->errors(),
            ];
        } else {
            try {
                $status = $this->receivEmail->insertOne($request->all());
                if ($status) {
                    $dataResponse = [
                        'status' => 'success',
                        'msg' => 'Cảm ơn bạn đã ủng hộ cửa hàng chúng tôi, rất vui được phục vụ bạn',
                    ];
                }
            } catch (\Throwable $th) {
                $dataResponse = [
                    'status' => 'errors',
                    'msg' => 'Hệ thống đang gặp sự cố, xin vui lòng thực hiện thao tác vào lúc khác',
                ];
            }
        }
        $respone = response()
        ->json($dataResponse)
        ->header('Content-Type', 'application/json');
        return $respone;
    }
}
