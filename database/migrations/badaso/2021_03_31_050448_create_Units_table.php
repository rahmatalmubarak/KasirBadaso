<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

        Schema::create('Units', function (Blueprint $table) {
            $table->integer('id')->default(null)->nullable(false)->autoIncrement();
			$table->string('name', 255)->default(null)->nullable(false);
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
        Schema::dropIfExists('Units');
    }
}
