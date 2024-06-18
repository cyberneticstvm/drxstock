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
        Schema::create('sales_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("sales_id");
            $table->string('eye', 15)->nullable();
            $table->unsignedBigInteger('product_id');
            $table->integer('qty')->default(0)->nullable();
            $table->decimal('price', 7, 2)->default(0)->nullable();
            $table->decimal('total', 7, 2)->default(0)->nullable();
            $table->boolean('is_return')->comment('null-no, 1-yes')->nullable();
            $table->unsignedBigInteger('returned_by')->nullable();
            $table->dateTime('returned_at')->nullable();
            $table->foreign("sales_id")->references("id")->on("sales")->onDelete("restrict");
            $table->foreign('product_id')->references('id')->on('products')->onDelete('restrict');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_details');
    }
};
