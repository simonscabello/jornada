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
        Schema::create('self_care_checkin_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('checkin_id')->constrained('self_care_checkins')->onDelete('cascade');
            $table->foreignId('question_id')->constrained('self_care_questions')->onDelete('cascade');
            $table->boolean('answer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('self_care_checkin_answers');
    }
};
