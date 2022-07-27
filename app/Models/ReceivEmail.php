<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReceivEmail extends Model
{
    use HasFactory;
    protected $table = 'receiv_emails';

    public function insertOne ($data){
        $status = DB::table($this->table)->insert([
            'email' => $data['email'],
            'created_at' => date('Y-m-d H:i:s')
        ]);
        return $status;
    }
}
