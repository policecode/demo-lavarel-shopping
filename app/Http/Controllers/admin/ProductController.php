<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Validator; 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Tag;
use App\Models\ProductTag;

class ProductController extends Controller
{
    private $category;
    private $product;
    private $productImage;
    private $tags;
    private $productTag;

    public function __construct(){
        $this->category = new Category();
        $this->productImage = new ProductImage();
        $this->product = new Product();
        $this->tags = new Tag();
        $this->productTag = new ProductTag();

    }

    function getProduct(Request $request) {
        $listCategory = $this->category->getAllCategory();
        // Dữ liệu đầu vào được lưu trong session
        $request->flash();
        // Lấy trang hiện tại
        $page = 1;
        if (!empty($request->_page)) {
            $page = $request->_page;
        }
        // Tìm kiếm theo từ khóa
        $keyword = null;
        if (!empty($request->keyword)) {
            $keyword = $request->keyword;
        }
        //Tìm kiếm theo danh mục
        $categoryId = null;
        if (!empty($request->category_id)) {
            $categoryId = $request->category_id;
        }
        
        $sessionData = [];
        if ($request->session()->has('delete')) {
            $value = $request->session()->pull('delete');
            $sessionData['delete'] = $value;
        }
        // Lấy dữ liệu
        $getAllProduct = $this->product->getAllProduct($page, $keyword, $categoryId);
        // Dữ liệu đưa ra màn hình
        $data = [
            'title' => 'Sản phẩm',
            'active' => 'product',
            'listCategory' => $listCategory,
            'getAllProduct' => $getAllProduct['getAllProduct'],
            'pagination' => handleRenderPagination($getAllProduct['currentPage'], $getAllProduct['pageNumber']),
            'queryArr' => $request->query(),
            'sessionData' => $sessionData
        ];
        return view('page.admin.product.list', $data);
    }

    function getFormAdd() {
        $listCategory = $this->category->getAllCategory();
        $allTag =  $this->tags->getAllTag();
        $data = [
            'title' => 'Thêm Sản phẩm',
            'active' => 'product',
            'listCategory' => $listCategory,
            'allTag' => $allTag,
        ];
        return view('page.admin.product.add', $data);
    }

    function createProduct(Request $request) {
        $rules = [
            'name' => ['required', 'min:4', 'unique:products,name'],
            'category_id' => 'required',
            'price' => 'required',
            'feature_image_path' => 'required',
            'content' => 'required',

        ];
        $messages = [
            'required' => ':attribute bắt buộc phải nhập',
            'unique' => ':attribute đã tồn tại',
        ];
        $attributes = [
            'name' => 'Tên sản phẩm',
            'category_id' => 'Danh mục',
            'price' => 'Giá sản phẩm',
            'feature_image_path' => 'Ảnh đại diện',
            'content' => 'Nội dung mô tả'
        ];
        $validator = Validator::make($request->all(), $rules, $messages, $attributes);
        if ($validator->fails()) {
            $validator->validate();
           
        } else {
            $idProduct = $this->product->insertProduct($request->all());
            if (!empty($idProduct)) {
                if (!empty($request->all()['image_path'])) {
                    $this->productImage->insertProductImage($idProduct, $request->all()['image_path']);
                }
                if (!empty($request->all()['tags'])) {
                    foreach ($request->all()['tags'] as $tagName) {
                        $idTag = $this->tags->insertTag($tagName);
                        if (!empty($idTag)) {
                            # code...
                            $this->productTag->insertProductTag($idProduct, $idTag);
                        }
                    }
                }
            }
        }
       
        return redirect()->route('admin.product.add')->with(['product' => 'Thêm sản phẩm thành công']);
    }

    function getFormUpdate(Request $request, $id) {
        $sessionData = [];
        if ($request->session()->has('update')) {
            $value = $request->session()->pull('update');
            $sessionData['update'] = $value;
        }
        $firstProduct = $this->product->getIdProduct($id);
        $listCategory = $this->category->getAllCategory();
        $listProductTag = $this->productTag->getProductTag($id);
        $allTag =  $this->tags->getAllTag();
        $listProductImage = $this->productImage->getProductImage($id);
        $data = [
            'title' => 'Thêm Sản phẩm',
            'active' => 'product',
            'firstProduct' => $firstProduct,
            'listCategory' => $listCategory,
            'allTag' => $allTag,
            'listProductTag' => $listProductTag,
            'listProductImage' => $listProductImage,
            'sessionData' => $sessionData
        ];
        return view('page.admin.product.update', $data);
    }

    function updateProduct(Request $request) {
        $rules = [
            'name' => ['required', 'min:4', 'unique:products,name,'.$request->id],
            'category_id' => 'required',
            'price' => 'required',
            'feature_image_path' => 'required',
            'content' => 'required',

        ];
        $messages = [
            'required' => ':attribute bắt buộc phải nhập',
            'unique' => ':attribute đã tồn tại',
        ];
        $attributes = [
            'name' => 'Tên sản phẩm',
            'category_id' => 'Danh mục',
            'price' => 'Giá sản phẩm',
            'feature_image_path' => 'Ảnh đại diện',
            'content' => 'Nội dung mô tả'
        ];
        $validator = Validator::make($request->all(), $rules, $messages, $attributes);
        if ($validator->fails()) {
            $validator->validate();
           
        } else {
            $productId = $request->id;
            $statusUpdate = $this->product->updateProduct($productId, $request->all());
            if ($statusUpdate) {
                // Xử lý bảng product_images
                if (!empty($request->image_path)) {
                    // Có dữ liệu image_path
                    $this->productImage->updateProductImage($productId, $request->image_path);
                } else {
                    // Không truyền vào image_path
                    $this->productImage->updateProductImage($productId);
                }

                // Xử lý bảng product_tags
                $getAllProductTag = $this->productTag->getProductTag($productId);
                $oldCount = $getAllProductTag->count();
                if (!empty($request->tags)) {
                    $tagArr = $request->tags;
                    // Tạo một mảng chứa id của các tag
                    $idTagArr = [];
                    foreach ($tagArr as $value) {
                        $idTagArr[] = $this->tags->insertTag($value);
                    }
                    $newCount = count($idTagArr);

                   

                    if ($oldCount == $newCount) {
                        foreach ($getAllProductTag as $key => $value) {
                            $this->productTag->updateProductTag($value->tag_id, $idTagArr[$key]);
                        }
                    }
                    if ($oldCount > $newCount) {
                        foreach ($getAllProductTag as $key => $value) {
                            if ($key < $newCount) {
                                $this->productTag->updateProductTag($value->tag_id, $idTagArr[$key]);
                            } else {
                                $this->productTag->deleteProductTag($value->tag_id);
                            }
                        }
                    }
                    if ($oldCount < $newCount) {
                        foreach ($idTagArr as $key => $tagId) {
                            if ($key < $oldCount) {
                                $this->productTag->updateProductTag($getAllProductTag[$key]->id, $tagId);
                            } else {
                                $this->productTag->insertProductTag($productId, $tagId);
                            }
                        }
                    }

                } else {
                    foreach ($getAllProductTag as $value) {
                        $this->productTag->deleteProductTag($value->tag_id);
                    }
                }
            }
        }
        $request->session()->put('update', 'Cập nhật dữ liệu thành công');
        // return redirect()->route('admin.product.add')->with(['product' => 'Thêm sản phẩm thành công']);
        return back();
    }

    function deleteProduct(Request $request) {
        $idProduct = $request->id;
        // Xóa bảng product_images
        $statusproductImage = $this->productImage->deleteWithProductId($idProduct);
        // Xóa bảng product_tags
        $statusProductTag = $this->productTag->deleteWithTagId($idProduct);
        // Xóa bảng products
        $statusProduct = $this->product->deleteProduct($idProduct);
        $request->session()->put('delete', 'Xóa sản phẩm thành công');
        return back();
    }
}
