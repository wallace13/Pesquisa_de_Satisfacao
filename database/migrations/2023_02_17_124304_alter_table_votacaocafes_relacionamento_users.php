<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableVotacaocafesRelacionamentoUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('votacaoalmocos', function(Blueprint $table) {
            $table->unsignedBigInteger('almoco_id')->nullable()->after('id');
            $table->foreign('almoco_id')->references('id')->on('almocos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('votacaoalmocos', function(Blueprint $table) {
            $table->dropForeign('votacaoalmocos_almoco_id_foreign');
            $table->dropColumn('almoco_id');
        });
    }
}
