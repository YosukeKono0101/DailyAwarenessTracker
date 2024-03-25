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
        Schema::create('custom_metrics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');                
            $table->unsignedBigInteger('custom_metric_type_id')->nullable();
            $table->unsignedBigInteger('daily_stat_id')->nullable();
            $table->string('name');
            $table->string('type');
            $table->string('value')->nullable();
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('daily_stat_id')->references('id')->on('daily_stats')->onDelete('set null');
        });        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_metrics');
    }
};
