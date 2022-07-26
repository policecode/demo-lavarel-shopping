<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductTag extends Model
{
    use HasFactory;
    protected $table = 'product_tags';

    public function getProductTag($productId) {
        $productTag = DB::table($this->table)
        ->select('id', 'tag_id')
        ->where('product_id', $productId)
        ->get();
        return $productTag;
    }
    public function insertProductTag($idProduct ,$tagId){
        $status = DB::table($this->table)->insert([
            'product_id' => $idProduct,
            'tag_id' => $tagId,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        return $status;
    }

    public function updateProductTag($id, $tagId) {
        DB::table($this->table)
        ->where('id', $id)
        ->update([
            'tag_id' => $tagId,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
    public function deleteProductTag($id) {
        DB::table($this->table)
        ->where('id', $id)
        ->delete();
    }

    public function deleteWithTagId($productId){
        $status = DB::table($this->table)
        ->where('product_id', $productId)
        ->delete();
        return $status;
    }
}
