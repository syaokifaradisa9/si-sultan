<?php

use App\Models\Order;
use App\Models\UserDivision;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDivisionOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('division_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(UserDivision::class)->constrained();
            $table->boolean('approved_by_kadiv')->default(false);
            $table->boolean('approved_by_mutu')->default(false);
            $table->boolean('approved_by_adum')->default(false);
            $table->boolean('approved_by_kepala')->default(false);
            $table->text('description_by_mutu')->nullable();
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
        Schema::dropIfExists('division_orders');
    }
}
