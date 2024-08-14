<?php

namespace Database\Seeders;

use App\Models\Plan;
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
        DB::table('plans')->insert(
            [
                'name' => 'Just Browsing',
                'plan_id' => "pri_01j45s6y5j82hb9j7hb482qd4m",
                'slug' => 'free',
                'features' => 'none',
                'description' => 'Lorem ipsum odor amet, consectetuer adipiscing elit. Suspendisse nunc vestibulum congue ut taciti tortor senectus.',
                'price' => 0,
            ],
            [
                'name' => 'Give Me More!',
                'plan_id' => "pri_01j4y51q2y31y5aepd313n4nae",
                'slug' => 'startup',
                'features' => 'none',
                'description' => 'Lorem ipsum odor amet, consectetuer adipiscing elit. Suspendisse nunc vestibulum congue ut taciti tortor senectus.',
                'price' => 99.89,
            ],
            [
                'name' => 'Lifetime',
                'plan_id' => "pri_01j4y56rbha1mrxrmd9qba3ryb",
                'slug' => 'lifetime',
                'features' => 'none',
                'description' => 'Lorem ipsum odor amet, consectetuer adipiscing elit. Suspendisse nunc vestibulum congue ut taciti tortor senectus.',
                'price' => 3000,
            ],
            [
                'name' => 'Agencies',
                'plan_id' => "pri_01j4y5dj8jmh6zzbg65kr9pt38",
                'slug' => 'agencies',
                'features' => 'none',
                'description' => 'Lorem ipsum odor amet, consectetuer adipiscing elit. Suspendisse nunc vestibulum congue ut taciti tortor senectus.',
                'price' => 149.89,
            ]
        );
    }
}
