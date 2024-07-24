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
            $table->string('name');
            $table->text('description')->nullable();
            // $table->text('weight');
            // $table->text('unit');
            $table->string('price');
            $table->string('picture');
            $table->string('slug')->unique();
            $table->foreignId('category_id')->constrained()->onUpdate("cascade")->onDelete("restrict");
            $table->foreignId('catalog_id')->constrained()->onUpdate("cascade")->onDelete("restrict");
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
