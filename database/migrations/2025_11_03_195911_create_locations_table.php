<?php
// database/migrations/2024_01_01_000004_create_locations_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('type')->default('city'); // city, district, region, virtual, national
            $table->foreignId('parent_id')->nullable()->constrained('locations')->nullOnDelete();
            $table->text('description')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index(['is_active', 'sort_order']);
            $table->index('slug');
            $table->index('type');
        });
    }

    public function down()
    {
        Schema::dropIfExists('locations');
    }
};