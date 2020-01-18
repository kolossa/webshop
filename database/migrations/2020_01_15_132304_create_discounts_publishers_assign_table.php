<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsPublishersAssignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discounts_publishers_assign', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->bigInteger('publisher_id', false, true);
            $table->bigInteger('discount_id')->unsigned();
            $table->timestamps();
			$table->foreign('publisher_id')->references('id')->on('publishers');
			$table->foreign('discount_id')->references('id')->on('discounts');
			$table->unique(['publisher_id', 'discount_id'], 'unique_publisher_discount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discounts_publishers_assign');
    }
}
