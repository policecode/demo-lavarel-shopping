<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tag extends Model
{
    use HasFactory;
    protected $table = 'tags';

    public function getAllTag(){
        $allTag = DB::table($this->table)->get();
        return $allTag;
    }

    // insert và lấy id hoặc lấy id nếu đã có
    public function insertTag($tagName){
        if ($this->searchTag($tagName)) {
            return $this->searchTag($tagName);
        } else {
            $idTag = DB::table($this->table)->insertGetId([
                'name' => $tagName,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            return $idTag;
        }
    }

    // Kiểm tra xem tag đã tồn tại trong DB hay chưa
    private function searchTag($tagName){
        $tag = DB::table($this->table)
        ->select('id')
        ->where('name', '=', $tagName)->first();
        if (empty($tag)) {
            return false;
        } else {
            return $tag->id;
        }
    }
}
