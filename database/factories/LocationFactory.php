<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique->randomElement([
                "Area 10", "Area 11", "Area 12", "Area 13", "Area 14", "Area 15", "Area 16", "Area 17", "Area 18", "Area 19",
                "Area 20", "Area 21", "Area 22", "Area 23", "Area 24", "Area 25", "Area 26", "Area 27", "Area 28", "Area 29",
                "Area 30", "Area 31", "Area 32", "Area 33", "Area 34", "Area 35", "Area 36", "Area 37", "Area 38", "Area 39",
                "Area 40", "Area 41", "Area 42", "Area 43", "Area 44", "Area 45", "Area 46", "Area 47", "Area 48", "Area 49",
                "Area 50", "Kanengo", "Lingadzi", "Mtandire", "Kawale", "Chinsapo", "Mchesi", "Kabula", "Senti", "Likuni",
                "Kawere", "Mchitanjiru", "Kauma", "Kawimbe", "Nthandire", "Chipasula", "Kawonga", "Ntandile", "Biwi", "Chilinde",
                "Kamuzu Institute", "Malingunde", "Namitete", "Kawale", "Madziabango", "Nankhaka", "Malingunde", "Bunda",
                "Bwaila", "Kamudzi", "Kanengo", "Sosola", "Mvunguti", "Mzuzu Road", "Civo Stadium", "Likuni Boys Secondary School"
            ]),
            // 'name' => $this->faker->word(),
            // 'region' => $this->faker->randomElement([
            //     "Central", "North", "South"
            // ]),
            'region' => "Central",
            // 'district' => $this->faker->unique()->randomElement([
            //     "Chitipa", "Karonga", "Likoma", "Mzimba", "Nkhata Bay", "Rumphi", "Dedza", "Dowa", "Kasungu", "Lilongwe", "Mchinji", "Nkhotakota", "Ntcheu", "Ntchisi", "Salima", "Balaka", "Blantyre", "Chikwawa", "Chiradzulu", "Machinga", "Mangochi", "Mulanje", "Mwanza", "Neno", "Nsanje", "Phalombe", "Thyolo", "Zomba",
            // ]),
            'district' => "Lilongwe",
            'description' => $this->faker->paragraph(),
        ];
    }
}
