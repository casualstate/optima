<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMitraIdToTbProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_project', function (Blueprint $table) {
            $table->integer('mitra_id')->default(0)->after('sto_id');
            $table->integer('progress_id')->default(0)->after('mitra_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_project', function (Blueprint $table) {
            $table->integer('mitra_id')->default(0)->after('sto_id');
            $table->integer('progress_id')->default(0)->after('mitra_id');
        });
    }
}
