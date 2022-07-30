<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DetailOrder extends Model
{
    use HasFactory;
    protected $table = 'detail_orders';

    public function insertOne($data, $order_id) {
        DB::table($this->table)->insert([
            'order_id' => $order_id,
            'product_id' => $data['id'],
            'qty' => $data['qty'],
            'price' => $data['price'],
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
