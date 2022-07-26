<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Setting extends Model
{
    use HasFactory;
    protected $table = 'settings';

    protected $fillable = [
        'opt_key',
        'opt_value',
        'name'
    ];

    public function updateSetting($dataUpdate) {
        $count = 0;
        foreach ($dataUpdate as $key => $item){
            if ($key != '_token' && $key != '_method') {
                DB::table($this->table)
                ->where('opt_key', $key)
                ->update([
                    'opt_value' => json_encode($item),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                $count++;
            }
        }

        return $count;
    }
}
