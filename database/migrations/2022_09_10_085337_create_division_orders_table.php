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
            $table->foreignIdFor(Order::class)->nullable()->constrained();
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
