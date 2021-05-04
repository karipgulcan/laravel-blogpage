<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Articles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id')->unsigned(); // category alanı categories tablomuzla ilişkili olduğu için unsigned sayesinde bağlantı kuracağız.
            $table->string('title');
            $table->string('image');
            $table->longText('content');
            $table->integer('hit')->default(0);
            $table->integer('status')->default(0)->comment('0:pasif 1:aktif');
            $table->string('slug');
            $table->softDeletes();
            $table->timestamps();


            $table->foreign('category_id')->references('id')->on('categories'); // categories tablomuzdaki id ile bu tablodaki category_id mizi ilişkilendiriyoruz.
            // onDelete('cascade') ->  Eğer categories tablosundan sütun silinirse bu tablodanda sil demekmiş.
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
