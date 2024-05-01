<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InlineDefectIndexTable extends Migration
{
    public function up()
    {
        Schema::connection('cmt')->create('inline_defect_index', function (Blueprint $table) {
            $table->string('line_id')->nullable();
            $table->datetime('date')->nullable();
            $table->integer('pf_retry')->nullable();
            $table->integer('pf_ng')->nullable();
            $table->integer('atsu_retry')->nullable();
            $table->integer('atsu_ng')->nullable();
        });
    }

    public function down()
    {
        Schema::connection('cmt')->dropIfExists('inline_defect_index');
    }
}
