<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('plans')->insert([
            [
                'name' => 'Gratuito',
                'description' => 'Funcionalidades básicas para começar a organizar suas finanças.',
                'price' => 0.00,
                'stripe_plan_id' => null, // Opcional para o plano gratuito
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pro',
                'description' => 'Relatórios avançados e acompanhamento de investimentos.',
                'price' => 29.90,
                'stripe_plan_id' => 'price_xxxxxxxxxxxxxx', // Substitua pelo ID do plano no Stripe
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Premium',
                'description' => 'Todas as funcionalidades Pro, mais suporte prioritário e consultoria financeira.',
                'price' => 59.90,
                'stripe_plan_id' => 'price_yyyyyyyyyyyyyy', // Substitua pelo ID do plano no Stripe
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}