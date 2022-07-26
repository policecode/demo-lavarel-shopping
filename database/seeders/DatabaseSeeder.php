<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

use Faker\Factory;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Setting::insert([
        //     'opt_key' => 'phone',
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'name' => 'Số điện thoại'
        // ]);
        // Setting::insert( [
        //         'opt_key' => 'email',
        //         'created_at' => date('Y-m-d H:i:s'),
        //         'name' => 'Email'
        //     ],);
        // Setting::insert(     [
        //     'opt_key' => 'facebook',
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'name' => 'Facebook'
        // ]);

        // for ($i=0; $i < 70; $i++) { 
        //     $faker = Factory::create();
        //     $tag = $faker->state;
        //     $check = DB::table('tags')
        //     ->where('name', $tag)
        //     ->get();
        //     if ($check->count() == 0) {
        //         DB::table('tags')->insert([
        //             'name' => $tag,
        //             'created_at' => date('Y-m-d H:i:s')
        //         ]);
        //     }
        // }

        // for ($i=0; $i < 50; $i++) { 
        //     $faker = Factory::create();
        //     $idProduct = DB::table('products')->insertGetId([
        //         'name' => $faker->name,
        //         'price' => mt_rand(1000000, 30000000),
        //         'feature_image_path' => $faker->imageUrl,
        //         'content' =>  json_encode($faker->realText),
        //         'user_id' => 1,
        //         'category_id' => rand(1, 39),
        //         'created_at' => date('Y-m-d H:i:s')
        //     ]);
        //     for ($j=0; $j < 4; $j++) { 
        //         DB::table('product_images')->insert([
        //             'image_path' => $faker->imageUrl,
        //             'product_id' => $idProduct,
        //             'created_at' => date('Y-m-d H:i:s')
        //         ]);
        //     }

        //     for ($e=0; $e < 4; $e++) { 
        //         DB::table('product_tags')->insert([
        //             'product_id' => $idProduct,
        //             'tag_id' => rand(1, 63),
        //             'created_at' => date('Y-m-d H:i:s')
        //         ]);
        //     }
        // }
    }
}
