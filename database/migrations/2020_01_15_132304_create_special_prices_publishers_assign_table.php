<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialPricesPublishersAssignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('special_prices_publishers_assign', function (Blueprint $table) {
            $table->bigInteger('publisher_id', false, true);
            $table->bigInteger('special_price_id');
            $table->timestamps();
			$table->primary(['publisher_id', 'special_price_id'], 'publisher_id_special_price_id_primary');
			$table->foreign('publisher_id')->references('id')->on('publishers');
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
        Schema::dropIfExists('special_prices_publishers_assign');
    }
}
