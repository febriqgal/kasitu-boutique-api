<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignUlid('user_id')->constrained('users');
            $table->string('image');
            $table->string('title');
            $table->text('desc');
            $table->bigInteger('price')->nullable()->default(0);
            $table->integer('stock')->nullable()->default(0);
            $table->bigInteger('discount')->nullable()->default(0);
            $table->bigInteger('total')->nullable()->default(0);
            $table->integer('sold')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
