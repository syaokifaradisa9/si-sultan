<?php

use App\Models\DivisionOrder;
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
            $table->foreignIdFor(DivisionOrder::class)->constrained();
            $table->foreignIdFor(Inventory::class)->nullable()->constrained();
            $table->string('usulan_thp');
            $table->integer('jumlah_thp');
            $table->text('spesifikasi_thp');
            $table->text('justifikasi_thp');
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
        Schema::dropIfExists('proposes');
    }
}
