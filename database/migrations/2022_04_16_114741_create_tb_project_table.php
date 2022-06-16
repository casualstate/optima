<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_project', function (Blueprint $table) {
            $table->id();
            $table->integer('permintaan_id');
            $table->integer('tematik_id');
            $table->integer('sto_id');
            $table->string('nama_project', 100);
            $table->string('estimasi_rab', 100);
            $table->string('tikor_lop', 100)->nullable();
            $table->string('lokasi_lop', 100)->nullable();
            $table->string('keterangan', 100)->nullable();
            $table->integer('add_by');
            $table->integer('edit_by');
            $table->string('status', 100);
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
        Schema::dropIfExists('tb_project');
    }
}
