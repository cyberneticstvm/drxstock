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
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('material_id');
            $table->unsignedBigInteger('coating_id');
            $table->enum('eye', ['RE', 'LE', 'Both']);
            $table->string('sph', 7)->nullable();
            $table->string('cyl', 7)->nullable();
            $table->string('axis', 7)->nullable();
            $table->string('add', 7)->nullable();
            $table->string('shelf', 150)->nullable();
            $table->string('box', 150)->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->timestamps();
            $table->softDeletes();
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
