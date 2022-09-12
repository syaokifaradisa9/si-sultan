<?php
use App\Models\Propose;
use App\Models\UserDivision;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revisions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Propose::class)->constrained();
            $table->foreignIdFor(UserDivision::class)->constrained();
            $table->string('nama_barang');
            $table->integer('jumlah_usulan_revisi');
            $table->string('spesifikasi');
            $table->string('justifikasi');
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
        Schema::dropIfExists('revisions');
    }
}
