<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id'); // nanti ini akan menjadi foreign key bagi table category
            $table->foreignId('user_id'); // nanti ini akan menjadi foreign key bagi table category
            $table->string('title');
            $table->string('slug')->unique(); // ini artinya slugnya tidak boleh ada yg sama, karena ini akan dijadikan url
            $table->string('image')->nullable(); // nullable itu boleh kosong fieldnya, nah nanti kalo kosong, gambarnya auto nampilin gambar yg defaultnya
            $table->text('excerpt'); // berisi bagian kecil teks yg nantinya jika user click read more, teknya muncul semua
            $table->text('body');
            $table->timestamp('published_at')->nullable();
            $table->timestamps(); // untuk membuat field created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
