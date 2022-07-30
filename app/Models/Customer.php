<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';

    public function insertOne($data) {
        $id = DB::table($this->table)->insertGetId([
            'fullname' => $data['fullname'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        return $id;
    }
}
