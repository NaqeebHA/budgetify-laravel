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
        Schema::create('apparels', function (Blueprint $table) {
            $table->id();
            $table->string('note');
            $table->string('color')->nullable();
            $table->text('description')->nullable();
            $table->text('attachment')->nullable();
            $table->unsignedInteger('qty')->default(1);
            $table->date('purchased_date')->nullable();
            $table->decimal('price')->default(0.00);
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('style_id')->nullable();
            $table->unsignedBigInteger('type_id')->nullable();
            $table->unsignedBigInteger('budget_id')->nullable();
            $table->timestamps();

            $table->foreign('brand_id')->references('id')->on('brands');
            $table->foreign('style_id')->references('id')->on('styles');
            $table->foreign('type_id')->references('id')->on('apparel_types');
            $table->foreign('budget_id')->references('id')->on('budgets');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apparel');
    }
};
