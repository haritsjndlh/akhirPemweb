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
        Schema::create('wallets', function(Blueprint $table){
            $table->increments('id_wallet');
            $table->unsignedInteger('id_user');
            $table->string('nama_wallet');
            $table->integer('saldo');
            $table->timestamps();
        });
        Schema::table('wallets', function(Blueprint $table){
            $table->foreign('id_user')
                ->references('id')
                ->On('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('wallets');
    }
};
