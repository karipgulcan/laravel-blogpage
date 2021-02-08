<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // database bağlantısını kurduk.

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories=['Çocuklar ve Etkinlik','Eğlence','Yazılım','Dene&Yap'];

        foreach($categories as $category){
            DB::table('categories')->insert([
                'name'=>$category,
                'slug'=>str::slug($category), // slug str_slug() şeklinde çalışmıyor update edilmiş
                'created_at'=>now(),
                'updated_at'=>now(),

            ]);
        }
    }
}
