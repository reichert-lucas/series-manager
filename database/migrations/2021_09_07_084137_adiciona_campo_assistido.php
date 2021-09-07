<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdicionaCampoAssistido extends Migration
{

    public function up()
    {
        Schema::table('episodios', function (Blueprint $table) { // Schema::table
            $table->boolean('assistido')->default(false); // criando nova coluna na tabela
        });
    }

    public function down()
    {
        Schema::table('episodios', function (Blueprint $table) {
            $table->dropColumn('assistido'); // para remover o campo caso queira reverter posteriormente
        });
    }
}
