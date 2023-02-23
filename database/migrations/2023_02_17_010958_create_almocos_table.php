<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlmocosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('almocos', function (Blueprint $table) {
            $table->id();
            $table->date('data')->unique();
            $table->string('salada', 200);
            $table->string('complemento', 200);
            $table->string('principal', 200);
            $table->string('sobremesa', 200);
            $table->string('suco', 200);
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
        Schema::dropIfExists('almocos');
    }
}
