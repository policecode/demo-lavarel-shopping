<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;


class Product extends Model
{
    use HasFactory;
    protected $table = 'products';

    public function getAllProduct($currentPage = 1, $keyword = null, $categoryId = null)
    {
        // dd($this->getCount($keyword, $categoryId));
        // Xử lý phân trang
        $pagination = handlePagination($this->getCount($keyword, $categoryId), $currentPage);
        DB::enableQueryLog();
        // Lấy dữ liệu
        $getAllProduct = DB::table($this->table)
            ->select($this->table . '.*', 'categories.name AS category_name')
            ->join('categories', $this->table . '.category_id', '=', 'categories.id');
        // Tìm kiếm theo keyword
        if (!empty($keyword)) {
            $getAllProduct = $getAllProduct->where(function ($query) use ($keyword) {
                $query->where($this->table . '.name', 'like', '%' . $keyword . '%');
                $query->orWhere('categories.name', 'like', '%' . $keyword . '%');
            });
        }
        // Tìm kiếm category
        if (!empty($categoryId)) {
            $getAllProduct = $getAllProduct->where('categories.id', $categoryId);
        }
        $getAllProduct = $getAllProduct->offset($pagination['startPage'])->limit($pagination['limit']);
        $getAllProduct = $getAllProduct->get();
        $sql = DB::getQueryLog();

        return [
            'getAllProduct' => $getAllProduct,
            'currentPage' => $currentPage,
            'pageNumber' => $pagination['pageNumber']
        ];
    }
    // Lấy số lượng bản ghi phục vụ cho phân trang
    private function getCount($keyword = null, $categoryId = null)
    {
        DB::enableQueryLog();
        $count =  DB::table($this->table)->select($this->table . '.id')
            ->join('categories', $this->table . '.category_id', '=', 'categories.id');;
        if (!empty($keyword)) {
            $count = $count->where(function ($query) use ($keyword) {
                $query->where($this->table . '.name', 'like', '%' . $keyword . '%');
                $query->orWhere('categories.name', 'like', '%' . $keyword . '%');
            });
        }
        // Tìm kiếm category
        if (!empty($categoryId)) {
            $count = $count->where('categories.id', $categoryId);
        }
        $count =  $count->get()->count();
        $sql = DB::getQueryLog();

        return $count;
    }

    public function getIdProduct($id)
    {
        $getIdProduct =  DB::table($this->table)
            ->where('id', $id)
            ->first();
        return $getIdProduct;
    }

    public function getLimit() {
        $list = DB::table($this->table)
        ->orderBy('created_at', 'DESC')
        ->offset(0)->limit(10)
        ->get();
        return $list;
    }
    public function insertProduct($data)
    {
        $dataInsert = [
            'name' => $data['name'],
            'price' => $data['price'],
            'feature_image_path' => $data['feature_image_path'],
            'content' => json_encode($data['content']),
            'category_id' => $data['category_id'],
            'user_id' => Auth::user()->id,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $id = DB::table($this->table)->insertGetId($dataInsert);

        return $id;
    }

    public function updateProduct($id, $data)
    {
        $dataupdate = [
            'name' => $data['name'],
            'price' => $data['price'],
            'feature_image_path' => $data['feature_image_path'],
            'content' => json_encode($data['content']),
            'category_id' => $data['category_id'],
            'updated_at' => date('Y-m-d H:i:s')

        ];
        $status = DB::table($this->table)
            ->where('id', $id)
            ->update($dataupdate);
        return $status;
    }

    public function deleteProduct($id)
    {
        $status = DB::table($this->table)
            ->where('id', $id)
            ->delete();
        return $status;
    }
}
