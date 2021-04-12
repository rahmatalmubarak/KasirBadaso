<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {

        Schema::create('suppliers', function (Blueprint $table) {
            $table->integer('id')->default(null)->nullable(false);
			$table->string('name', 50)->default(null)->nullable(false);
			$table->string('address', 255)->default(null)->nullable(false);
			$table->string('telephone', 15)->default(null)->nullable(false);
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
        Schema::dropIfExists('suppliers');
    }
}
