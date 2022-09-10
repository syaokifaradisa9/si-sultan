<?php

use App\Models\Inventory;
use App\Models\UserDivision;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(UserDivision::class)->constrained();
            $table->foreignIdFor(Inventory::class)->constrained();
            $table->string('nama_barang');
            $table->integer('jumlah_usulan');
            $table->string('spesifikasi');
            $table->string('justifikasi');
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('proposes');
    }
}
