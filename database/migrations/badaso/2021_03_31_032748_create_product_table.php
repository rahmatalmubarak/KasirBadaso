<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

        Schema::create('product', function (Blueprint $table) {
            $table->integer('id')->default(null)->nullable(false)->autoIncrement();
			$table->string('name', 25)->default(null)->nullable(false);
			$table->integer('type')->default(null)->nullable(false);
			$table->integer('unit_id')->default(null)->nullable(false);
			$table->integer('capital')->default(null)->nullable(false);
			$table->integer('sell')->default(null)->nullable(false);
			$table->integer('stock')->default(null)->nullable(false);
			$table->string('code_product', 11)->default(null)->nullable(false);
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
        Schema::dropIfExists('product');
    }
}
