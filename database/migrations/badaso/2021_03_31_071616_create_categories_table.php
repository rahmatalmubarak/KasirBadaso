<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

        Schema::create('categories', function (Blueprint $table) {
            $table->integer('id')->default(null)->nullable(false)->autoIncrement();
			$table->string('name', 25)->default(null)->nullable(false);
			$table->string('describe', 255)->default(null)->nullable(false);
			$table->timestamps();
        });
            
        } catch (PDOException $ex) {
            $this->down();
            throw $ex;
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
