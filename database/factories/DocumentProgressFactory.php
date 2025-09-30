<?php

namespace Database\Factories;

use App\Models\Document;
use App\Models\DocumentWorkflow;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DocumentProgress>
 */
class DocumentProgressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $isChecked = $this->faker->boolean(50);

        return [
            'document_id' => Document::inRandomOrder()->first()?->id ?? 1,
            'workflow_id' => DocumentWorkflow::inRandomOrder()->first()?->id ?? 1,
            'is_checked' => $isChecked,
            'checked_at' => $isChecked ? Carbon::now()->subDays(rand(1, 30)) : null,
            'description' => $isChecked ? $this->faker->sentence() : null,
            'checked_by' => $isChecked ? (User::inRandomOrder()->first()?->id ?? null) : null,
        ];
    }
}
