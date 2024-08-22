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
        Schema::create('adverts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->string('title')->unique();
            $table->string('slug')->unique();
            $table->longText('body');
            $table->datetime('deadline')->nullable();
            $table->string('location');
            $table->string('sector');
            $table->string('education_level')->nullable();
            $table->string('desired_experience')->nullable();
            $table->string('contract_type')->nullable();
            $table->integer('number_of_positions')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adverts');
    }
};
