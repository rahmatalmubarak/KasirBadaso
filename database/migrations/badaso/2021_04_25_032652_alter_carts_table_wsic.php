<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCartsTableWsic extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
            DB::beginTransaction();

        Schema::table('carts', function (Blueprint $table) {
            $table->renameColumn('produk', 'product_id');
        }); 
            
            DB::commit();
        } catch (PDOException $ex) {
            DB::rollBack();
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
        Schema::table('carts', function (Blueprint $table) {
            $table->renameColumn('product_id', 'produk');
        }); 
    }
}
