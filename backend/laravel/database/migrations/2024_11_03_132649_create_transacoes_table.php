<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransacoesTable extends Migration
{
    public function up()
{
    Schema::create('transacoes', function (Blueprint $table) {
        $table->id();
        $table->string('descricao');
        $table->decimal('valor', 10, 2);
        $table->enum('tipo', ['receita', 'despesa']);
        $table->string('categoria');
        $table->timestamps();
    });
}

    public function down()
    {
        Schema::dropIfExists('transacoes');
    }
}