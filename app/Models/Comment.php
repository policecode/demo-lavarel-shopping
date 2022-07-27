<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';

    public function getAllCommentProductId($productId) {
        $listComment = DB::table($this->table)
        ->where('product_id', $productId)
        ->orderBy('created_at', 'desc')
        ->get();
        return $listComment;
    }

    public function insertOne($data) {
        DB::table($this->table)->insert([
            'email' => $data['email'],
            'fullname' => $data['fullname'],
            'comment' => $data['comment'],
            'product_id' => $data['product_id'],
            'parent_id' => $data['parent_id'],
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
