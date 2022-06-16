<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPermintaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_permintaan', function (Blueprint $table) {
            $table->id();
            $table->integer('tematik_id');
            $table->date('tanggal_permintaan');
            $table->string('reff_permintaan', 100)->nullable();
            $table->string('nama_permintaan', 100)->nullable();
            $table->string('pic_permintaan', 100)->nullable();
            $table->string('keterangan', 255)->nullable();
            $table->integer('add_by');
            $table->integer('edit_by');
            $table->string('status', 100);
            $table->string('status_nodin', 100);
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
        Schema::dropIfExists('tb_permintaan');
    }
}
