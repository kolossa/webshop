<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsBooksAssignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts_books_assign', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->bigInteger('book_id');
            $table->bigInteger('discount_id')->unsigned();
            $table->timestamps();
			$table->foreign('book_id')->references('id')->on('books');
			$table->foreign('discount_id')->references('id')->on('discounts');
			$table->unique(['book_id', 'discount_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discounts_books_assign');
    }
}
