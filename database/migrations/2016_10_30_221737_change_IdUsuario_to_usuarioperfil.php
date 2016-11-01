<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeIdUsuarioToUsuarioperfil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('usuarioperfil', function (Blueprint $table) {
            // Add our wanted foreign key
            $table->foreign('IdUsuario')
                  ->references('id')->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('usuarioperfil', function (Blueprint $table) {
            $table->foreign('IdUsuario')
                  ->references('IdUsuario')->on('usuario');
        });
        Schema::enableForeignKeyConstraints();
    }
}
