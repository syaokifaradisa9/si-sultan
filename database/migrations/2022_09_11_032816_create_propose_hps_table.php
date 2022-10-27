<?php

use App\Models\DivisionOrder;
use App\Models\InventoryHp;
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
            $table->foreignIdFor(InventoryHp::class)->nullable()->constrained();
            $table->string('usulan_hp');
            $table->integer('jumlah_hp');
            $table->text('spesifikasi_hp');
            $table->text('justifikasi_hp');
            $table->enum('status', [
                'diajukan', 'disetujui', 'ditunda', 'diajukan kembali'
            ])->default('diajukan');
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
