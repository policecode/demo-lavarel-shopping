<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Slider extends Model
{
    use HasFactory;
    protected $table = 'sliders';


    public function getAll() {
        $list = DB::table($this->table)->get();
        return $list;
    }

    public function getId($id) {
        $first = DB::table($this->table)
        ->where('id', $id)
        ->first();
        return $first;
    }

    public function create($data) {
      
        $status = DB::table($this->table)->insert([
            'name' => $data['name'],
            'description' => $data['description'],
            'image_path' => $data['image_path'],
            'created_at' => date('Y-m-d H:i:s')
        ]);
        return $status;
    }

    public function updateOne($data) {
        $status = DB::table($this->table)
        ->where('id', $data['id'])
        ->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'image_path' => $data['image_path'],
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        return $status;
    }

    function deleteId($id){
        $status = DB::table($this->table)
        ->where('id', $id)
        ->delete();
        return $status;
    }
}
