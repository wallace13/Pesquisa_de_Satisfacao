<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableVotacaoalmocosRelacionamentoUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('votacaocafes', function(Blueprint $table) {
            $table->unsignedBigInteger('cafe_id')->nullable()->after('id');
            $table->foreign('cafe_id')->references('id')->on('cafes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('votacaocafes', function(Blueprint $table) {
            $table->dropForeign('votacaocafes_cafe_id_foreign');
            $table->dropColumn('cafe_id');
        });
    }
}
