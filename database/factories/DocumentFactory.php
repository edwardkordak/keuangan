<?php

namespace Database\Factories;

use App\Models\DocumentType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->company(),
            'nama_dokumen' => $this->faker->sentence(3),
            'jenis_id' => DocumentType::inRandomOrder()->first()?->id ?? 1,
            'tanggal_diterima' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'file_path' => 'documents/' . $this->faker->word() . '.pdf',
        ];
    }
}
