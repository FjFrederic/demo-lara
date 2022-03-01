<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billetages', function (Blueprint $table) {
            $table->id();
            $table->integer('nominal')->unsigned();
            $table->integer('quantite')->unsigned();
            $table->float('montant')->unsigned();
            $table->integer('type_monnaie'); // 1 : billets, 2: pieces, 3: centimes
            $table->integer('operation_id');
            $table->foreign('operation_id')
                ->references('id')->on('operations')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billetages');
    }
};
