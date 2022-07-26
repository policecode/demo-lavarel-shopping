<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
// use Carbon\Carbon;
class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';

    public function getAllCategory(){
        $list = DB::table($this->table)
        ->where('deleted_at', null)
        ->get();
        return $list;
    }

    public function getFirstCategory($id) {
        $first = DB::table($this->table)
        ->where('deleted_at', null)
        ->where('id', $id)
        ->first();
        return $first;
    }

    public function insertCategory($data) {
        // $dataInsert['create_at'] = Carbon::now();
        $dataInsert = [
            'name' => $data['name'],
            'parent_id' => $data['parent_id'],
            'slug' => $data['slug'],
            'icon' => $data['icon'],
            'created_at' => date('Y-m-d H:i:s')
        ];
       
        $status = DB::table($this->table)->insert($dataInsert);

        return $status;
    }

    public function updateCategory($data) {
        // $dataInsert['create_at'] = Carbon::now();
        $dataUpdate = [
            'name' => $data['name'],
            'parent_id' => $data['parent_id'],
            'slug' => $data['slug'],
            'icon' => $data['icon'],
            'updated_at' => date('Y-m-d H:i:s')
        ];
       
        $status = DB::table($this->table)
        ->where('id', $data['id'])
        ->update($dataUpdate);

        return $status;
    }

    public function deleteCategory($id) {
        // $dataInsert['create_at'] = Carbon::now();
        $delete = [
            'deleted_at' => date('Y-m-d H:i:s')
        ];
       
        $status = DB::table($this->table)
        ->where('id', $id)
        ->update($delete);

        return $status;
    }
}
