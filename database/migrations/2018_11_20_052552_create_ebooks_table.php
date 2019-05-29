<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ebooks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ebook_title');
            $table->string('ebook_isbn');
            $table->date('pub_date')->nullable();
            $table->string('edition')->nullable();
            $table->integer('a_id');
            $table->integer('g_id');
            $table->integer('p_id');
            $table->integer('ebook_page');
            $table->string('ebook_cover')->nullable();
            $table->string('ebook_pdf')->nullable();
            $table->string('ebook_desc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ebooks');
    }
}
