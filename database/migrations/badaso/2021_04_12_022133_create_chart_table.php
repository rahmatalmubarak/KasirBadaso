<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

        Schema::create('chart', function (Blueprint $table) {
            $table->integer('id')->default(null)->nullable(false)->autoIncrement();
			$table->integer('produk')->default(null)->nullable(false);
			$table->integer('total')->default(null)->nullable(false);
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
        Schema::dropIfExists('chart');
    }
}
