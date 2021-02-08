<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB; // database bağlantısını kurduk.

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoris=['Çocuklar ve Etkinlik','Eğlence','Yazılım','Dene&Yap'];

        foreach($categoris as $category){
            DB::table('categories')->insert([
                'name'=>$category,
                'slug'=> str_slug($category)
            ]);
        }
    }
}
