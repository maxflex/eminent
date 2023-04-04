<?php

use App\Enums\FinishBy;
use App\Models\User;
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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained();
            $table->date('date')->nullable()->index();
            $table->time('time')->nullable();
            $table->enum('finish_by', array_map(fn ($e) => $e->name, FinishBy::cases()))->nullable();
            $table->boolean('is_finished')->default(false)->index();
            $table->string('title');
            $table->string('comment')->nullable();
            $table->smallInteger('pts')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
