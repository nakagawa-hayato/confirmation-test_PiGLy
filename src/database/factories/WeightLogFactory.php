<?php

namespace Database\Factories;

use App\Models\WeightLog;
use Illuminate\Database\Eloquent\Factories\Factory;

class WeightLogFactory extends Factory
{
    protected $model = WeightLog::class;

    public function definition()
    {
        return [
        'user_id' => 1,
        'date' => $this->faker->date(),
        'weight' => $this->faker->randomFloat(1, 40, 100), // 40〜100kg、小数点1桁
        'calories' => $this->faker->numberBetween(1500, 3000), // 摂取カロリー
        'exercise_time' => $this->faker->time('H:i'), // 時間
        'exercise_content' => $this->faker->sentence(3), // 適当な文章
        ];
    }
}
