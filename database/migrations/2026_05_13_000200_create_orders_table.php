<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_no')->unique();
            $table->unsignedInteger('total_qty')->default(0);
            $table->decimal('total_amount', 12, 2)->default(0);
            $table->unsignedInteger('items_count')->default(0);
            $table->string('status')->default('pending');
            $table->string('payment_status')->default('pending');
            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
