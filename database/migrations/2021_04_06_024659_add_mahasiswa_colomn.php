<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMahasiswaColomn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->string('email', 50)->after('jurusan')->nullable();
            $table->string('tgl_lahir', 30)->after('no_tlp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('tgl_lahir');
        });
    }
}
