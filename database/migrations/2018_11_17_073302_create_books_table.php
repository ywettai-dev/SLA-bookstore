<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('b_title');
            $table->string('b_isbn');
            $table->integer('b_qty');
            $table->date('pub_date')->nullable();
            $table->string('edition')->nullable();
            $table->integer('a_id');
            $table->integer('g_id');
            $table->integer('p_id');
            $table->integer('s_id');
            $table->integer('b_page');
            $table->float('b_price');
            $table->string('b_cover')->nullable();
            $table->string('b_desc')->nullable();
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
        Schema::dropIfExists('books');
    }
}
