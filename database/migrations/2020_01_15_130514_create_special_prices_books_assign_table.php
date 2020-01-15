<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialPricesBooksAssignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_prices_books_assign', function (Blueprint $table) {
            $table->bigInteger('book_id');
            $table->bigInteger('special_price_id');
            $table->timestamps();
			$table->primary(['book_id', 'special_price_id']);
			$table->foreign('book_id')->references('id')->on('books');
			$table->foreign('special_price_id')->references('id')->on('special_prices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('special_prices_books_assign');
    }
}
