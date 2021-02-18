<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages=['Hakkımızda','Kariyer','Misyonumuz','Vizyonumuz'];
        $count=0;
        foreach($pages as $page){
            $count++;
            DB::table('pages')->insert([
                'title'=>$page,
                'slug'=>str::slug($page), // slug str_slug() şeklinde çalışmıyor update edilmiş
                'image'=>'https://blackstoneconsultancy.com/wp-content/uploads/2019/03/iStock-1026914886.jpg',
                'content'=>'Lorem',
                'order'=>$count,
                'created_at'=>now(),
                'updated_at'=>now(),

            ]);
        }
    }
}
