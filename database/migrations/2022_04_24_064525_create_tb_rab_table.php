<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbRabTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_rab', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->double('biaya');
            $table->string('document', 100)->nullable();
            $table->date('dt_target');
            $table->integer('add_by');
            $table->integer('edit_by');
            $table->string('status', 100)->nullable();
            $table->string('keterangan', 100)->nullable();
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
        Schema::dropIfExists('tb_rab');
    }
}
