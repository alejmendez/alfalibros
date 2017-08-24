<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AppUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_usuario', function(Blueprint $table){
            $table->increments('id');
            
            $table->string('usuario', 100)->nullable();
            $table->string('password', 60);

            $table->integer('perfil_id')->unsigned()->nullable();
            $table->integer('persona_id')->unsigned()->nullable();

            $table->string('codigo', 50)->nullable();
            $table->char('confirmado', 1)->default('n');

            $table->char('super', 1)->default('n');

            $table->rememberToken();
            
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('perfil_id')
                ->references('id')->on('app_perfil')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_usuario');
    }
}
