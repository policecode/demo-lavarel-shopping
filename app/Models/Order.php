<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    public function insertOne($data, $customer_id, $totalPrice) {
        $id = DB::table($this->table)->insertGetId([
            'customer_id' => $customer_id,
            'address' => $data['address'],
            'total_price' => $totalPrice,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        return $id;
    }
}
