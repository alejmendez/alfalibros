<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AppUsuarioDireccion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_direccion', function(Blueprint $table){
            $table->increments('id');
            $table->integer('usuario_id')->unsigned();
            $table->string('nombre_direccion', 150);
            $table->string('persona_contacto', 150)->nullable();
            $table->string('telefono', 20)->nullable();
            $table->string('estado', 50);
            $table->string('ciudad', 50);
            $table->string('codigo_postal', 50);
            $table->text('direccion', 250);
            $table->text('punto_referencia',250)->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('usuario_id')
                ->references('id')->on('app_usuario')
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
        Schema::dropIfExists('usuarios_direccion');
    }
}
