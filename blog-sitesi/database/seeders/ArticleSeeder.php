<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();
        for($i=0;$i<4;$i++){
            $title=$faker->sentence(6);
            DB::table('articles')->insert([
                'category_id'=>rand(1,4),
                'title'=>$title,
                'image'=>$faker->imageUrl(800,400,'cats',true,'Faker',true, 'Gülcan Karip'),
                'content'=>$faker->paragraph(6),
                'slug'=>str::slug($faker->title),
                'created_at'=>now(),
                'updated_at'=>now()

            ]);
        }
    }
}
