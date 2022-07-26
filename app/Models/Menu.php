<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menus';

    public function getAllMenu(){
        $list = DB::table($this->table)
        ->where('deleted_at', null)
        ->get();
        return $list;
    }

    public function getFirstMenu($id) {
        $first = DB::table($this->table)
        ->where('deleted_at', null)
        ->where('id', $id)
        ->first();
        return $first;
    }

    public function insertMenu($data) {
        // $dataInsert['create_at'] = Carbon::now();
        $dataInsert = [
            'name' => $data['name'],
            'parent_id' => $data['parent_id'],
            'created_at' => date('Y-m-d H:i:s')
        ];
        if (!empty($data['link'])) {
            $dataInsert['link'] = $data['link'];
        } else {
            $dataInsert['link'] = '#';
        }
        $status = DB::table($this->table)->insert($dataInsert);

        return $status;
    }

    public function updateMenu($data) {
        // $dataInsert['create_at'] = Carbon::now();
        $dataUpdate = [
            'name' => $data['name'],
            'parent_id' => $data['parent_id'],
            'updated_at' => date('Y-m-d H:i:s')
        ];
        if (!empty($data['link'])) {
            $dataInsert['link'] = $data['link'];
        } 

        $status = DB::table($this->table)
        ->where('id', $data['id'])
        ->update($dataUpdate);

        return $status;
    }

    public function deleteMenu($id) {
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
