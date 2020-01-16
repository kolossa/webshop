<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorsBooksAssignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors_books_assign', function (Blueprint $table) {
            $table->bigInteger('author_id', false, true);
            $table->bigInteger('book_id');
            $table->timestamps();
			$table->primary(['author_id', 'book_id']);
			$table->foreign('author_id')->references('id')->on('authors');
			$table->foreign('book_id')->references('id')->on('books');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authors_books_assign');
    }
}
