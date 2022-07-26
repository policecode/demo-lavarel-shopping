<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductImage extends Model
{
    use HasFactory;
    protected $table = 'product_images';

    public function getProductImage($productId) {
        $listProductImage = DB::table($this->table)
        ->select('id', 'image_path')
        ->where('product_id', $productId)
        ->get();

        return $listProductImage;
    }
    public function insertProductImage($idProduct, $dataArrImage){
        if (!empty($dataArrImage)) {
            foreach ($dataArrImage as $value) {
                DB::table($this->table)->insert([
                    'image_path' => $value,
                    'product_id' => $idProduct,
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }
        }
    }

    public function updateProductImage($productId, $newArr = []){
        // Lấy số lượng phần tử mảng cũ collect
        $oldCollect = $this->getProductImage($productId);
        $oldCount = $oldCollect->count();
        // Đếm số lượng phần tử mảng mới Arr
        $newCount = count($newArr);
        if (!empty($newArr)) {
            // TH1
            if ($oldCount == $newCount) {
                foreach ($oldCollect as $key => $value) {
                    $dataUpdate = [
                        'image_path' => $newArr[$key],
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
                    $this->updateOneData($value->id, $dataUpdate);
                }
            }
            // TH2
            if ($oldCount > $newCount) {
                foreach ($oldCollect as $key => $value) {
                    if ($key < $newCount) {
                        $dataUpdate = [
                            'image_path' => $newArr[$key],
                            'updated_at' => date('Y-m-d H:i:s')
                        ];
                        $this->updateOneData($value->id, $dataUpdate);
                    } else {
                        $this->deleteOneData($value->id);
                    }
                }
            }
            // TH3
            if ($oldCount < $newCount) {
                foreach ($newArr as $key => $value) {
                    if ($key < $oldCount) {
                        $dataUpdate = [
                            'image_path' => $value,
                            'updated_at' => date('Y-m-d H:i:s')
                        ];
                        $this->updateOneData($oldCollect[$key]->id, $dataUpdate);
                    } else {
                        $dataInsert = [
                                'image_path' => $value,
                                'product_id' => $productId,
                                'created_at' => date('Y-m-d H:i:s')
                        ];
                        $this->insertOneData($dataInsert);
                    }
                }
            }
        } else {
            foreach ($oldCollect as $value) { 
                $this->deleteOneData($value->id);
            }
        }
    }

    private function updateOneData($id, $data){
        DB::table($this->table)
        ->where('id', $id)
        ->update($data);
    }
    private function deleteOneData($id) {
        DB::table($this->table)
        ->where('id', $id)
        ->delete();
    }
    private function insertOneData($data){
        DB::table($this->table)->insert($data);
    }

    public function deleteWithProductId($productId){
        $status = DB::table($this->table)
        ->where('product_id', $productId)
        ->delete();
        return $status;
    }
}
