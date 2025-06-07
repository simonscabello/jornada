<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SelfCareQuestion;

class SelfCareQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            'Você dormiu bem hoje?',
            'Você se alimentou adequadamente hoje?',
            'Você praticou alguma atividade física hoje?',
            'Você dedicou tempo para seu lazer hoje?',
            'Você cuidou da sua saúde mental hoje?',
        ];

        foreach ($questions as $question) {
            SelfCareQuestion::firstOrCreate(
                ['question' => $question],
                ['is_default' => true]
            );
        }
    }
}
