<?php

use App\Models\DivisionOrder;
use App\Models\UserDivision;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposeHpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propose_hps', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(DivisionOrder::class)->constrained();
            $table->string('usulan_hp');
            $table->integer('jumlah_hp');
            $table->string('spesifikasi_hp');
            $table->string('justifikasi_hp');
            $table->enum('status', [
                'diajukan', 'disetujui', 'ditunda'
            ]);
            $table->text('deskripsi')->nullable();
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
        Schema::dropIfExists('propose_hps');
    }
}
