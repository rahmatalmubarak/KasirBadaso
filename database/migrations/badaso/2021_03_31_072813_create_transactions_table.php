<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

        Schema::create('transactions', function (Blueprint $table) {
            $table->integer('id')->default(null)->nullable(false)->autoIncrement();
			$table->integer('users_id')->default(null)->nullable(false);
			$table->dateTime('date')->default(null)->nullable(false);
			$table->integer('profit')->default(null)->nullable(false);
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
        Schema::dropIfExists('transactions');
    }
}
