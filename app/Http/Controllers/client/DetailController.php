<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Facades\Auth;
// Model
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Models\Comment;
// rule
use App\Rules\StringAdmin;
class DetailController extends Controller
{
    private $product;
    private $productImage;
    private $productTag;
    private $comment;
    public function __construct()
    {
        $this->product = new Product();
        $this->productImage = new ProductImage();
        $this->productTag = new ProductTag();
        $this->comment = new Comment();

    }
    public function detailProduct($id) {
        try {
            $product = $this->product->getIdProduct($id);
            $imageProduct = $this->productImage->getProductImage($id);
            $tagProduct = $this->productTag->getProductTag($id);
            $listComment = $this->comment->getAllCommentProductId($id);
            $listProduct = $this->product->getLimit();
        } catch (\Throwable $th) {
            dd('Đang gặp lỗi');
        }
        $data = [
            'title' => 'Sản phẩm',
            'active' => 'detail',
            'product' => $product,
            'imageProduct' => $imageProduct,
            'tagProduct' => $tagProduct,
            'listComment' => $listComment,
            'listProduct' => $listProduct,
            'authCheck' => Auth::check(), //true or false
        ];
        if (Auth::check()) {
            $data['authAdmin'] = Auth::user()->name.' (Admin)';
        }
        return view('page.client.detail', $data);
    }

    public function commentProduct(Request $request) {
        $request->flash();

        $rules = [
            'fullname' => 'required|min:4',
            'email' => ['required', 'email'],
            'comment' => ['required','unique:categories,slug'],

        ];
        if (!Auth::check()) {
            $rules['email'] = ['required', 'email', new StringAdmin];
        }
        $messages = [
            'required' => ':attribute bắt buộc phải nhập',
            'min' => ':attribute không được nhỏ hơn :min ký tự',
            'unique' => ':attribute đã tồn tại trong hệ thống',
        ];
        $attributes = [
            'fullname' => 'Họ tên',
            'email' => 'Địa chỉ email',
            'comment' => 'Bình luận'
        ];
        $validator = Validator::make($request->all(), $rules, $messages, $attributes);
        if ($validator->fails()) {
            $validator->validate();
        } else {
            try {
                $this->comment->insertOne($request->all());
            } catch (\Throwable $th) {
                
            }
            return back();
        }
    }
}
