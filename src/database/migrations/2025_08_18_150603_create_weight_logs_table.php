<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeightLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('weight_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->date('date');                          // 記録日
            $table->decimal('weight', 5, 1);              // 4桁＋小数1桁（例: 9999.9）
            $table->unsignedInteger('calories')->nullable();       // 食事摂取カロリー(kcal)
            $table->time('exercise_time')->nullable(); // 運動時間（time型）
            $table->text('exercise_content')->nullable(); // 運動内容（text型）
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weight_logs');
    }
}
