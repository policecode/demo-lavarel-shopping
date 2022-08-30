<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 

// Model
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Models\Comment;
class DetailController extends Controller
{
    public function detailProduct($id) {
        try {
            $product = Product::find($id);
            $imageProduct = ProductImage::where('product_id', $id)->get();
            $tagProduct = ProductTag::where('product_id', $id)->get();
            $listComment = Comment::where('product_id', $id)->get();
            $listProduct = Product::offset($id)->limit(10)->get();
            $data = [
                'status' => 'success',
                'product' => $product,
                'imageProduct' => $imageProduct,
                'tagProduct' => $tagProduct,
                'listComment' => $listComment,
                'listProduct' => $listProduct,
            ];
        } catch (\Throwable $th) {
            $data = [
                'status' => 'error',
                'message' => $th->getMessage(),
            ];
        }
      
        return $data;
    }

    public function commentProduct(Request $request) {
        $rules = [
            'fullname' => 'required|min:4',
            'email' => ['required', 'email'],
            'comment' => ['required'],
        ];
        $messages = [
            'required' => ':attribute bắt buộc phải nhập',
            'min' => ':attribute không được nhỏ hơn :min ký tự',
            'email' => ':attribute không đúng định dạng email',
        ];
        $attributes = [
            'fullname' => 'Họ tên',
            'email' => 'Địa chỉ email',
            'comment' => 'Bình luận'
        ];
        $validator = Validator::make($request->all(), $rules, $messages, $attributes);
        if ($validator->fails()) {
            $data = [
                'status' => 'errorForm',
                'errMess' => $validator->errors(),
            ];
        } else {
            try {
                $comment = new Comment();
                $comment->email = $request->email;
                $comment->fullname = $request->fullname;
                $comment->comment = $request->comment;
                $comment->product_id = $request->product_id;
                $comment->parent_id = $request->parent_id;
                $comment->created_at = date('Y-m-d H:i:s');
                $comment->save();
                $data = [
                    'status' => 'success',
                    'listComment' => Comment::where('product_id', $request->product_id)->get()
                ];
            } catch (\Throwable $th) {
                $data = [
                    'status' => 'error',
                    'err' => [
                        'message' => $th->getMessage(),
                        'line' => $th->getLine(),
                        ]
                ];
            }
        }
        return $data;
    }
}
