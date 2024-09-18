<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('plans')->insert([
            [
                'id' => Str::uuid(),
                'name' => 'Free Plan',
                'product_id' => 'pro_01j45s583c8f48mbqa98p8qek1',
                'plan_id' => 'pri_01j45s6y5j82hb9j7hb482qd4m',
                'slug' => 'free',
                'features' => 'Unlock all platform features\ Manage up to <b>2 accounts</b>\ <b>$100</b> one-time fee per additional account\ No subscriptions, no hidden fees\ Perfect for testing, exploring, and expanding at your own pace',
                'description' => 'Jumpstart your journey—completely free!',
                'monthly_price' => null,  // Free plan has no monthly price
                'monthly_price_id' => null,
                'annual_price' => null,   // Free plan has no annual price
                'annual_price_id' => null,
                'one_time_price' => 0,
                'max_accounts' => 3,
                'billing_cycle' => null,
                'is_one_time' => 1,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Account',
                'product_id' => 'pro_01j7qtxdn40d0x91fkyhfh4ayg',
                'plan_id' => null,
                'slug' => 'account',
                'features' => 'Manage up to <b>50 accounts</b>\ Affordable scaling: <b>$50</b> one-time fee per additional account\ Predictable pricing that helps you scale smarter',
                'description' => 'Ideal for small and growing teams.',
                'monthly_price' => 49.99,  // Monthly subscription price
                'monthly_price_id' => "pri_01j7qtzy38nz08yzqw7vzj042v",  // Paddle ID for monthly
                'annual_price' => 479.90,  // Annual subscription price
                'annual_price_id' => "pri_01j7qv4gc20rsa9qqj2hbt2y7k",  // Paddle ID for annual
                'one_time_price' => null,  // No one-time price for this plan
                'max_accounts' => 50,
                'billing_cycle' => 'monthly',
                'is_one_time' => 0,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Agency',
                'product_id' => 'pro_01j4y5bpsy1z87q8qqyz056jfg',
                'plan_id' => null,
                'slug' => 'agency',
                'features' => 'Ideal for scaling businesses\ Manage up to <b>100 accounts</b>\ Easy account expansion: Add more accounts for just <b>$25</b> one-time fee per additional account\ Push boundaries and grow faster\ Streamlined, powerful, and budget-friendly',
                'description' => 'Tailored for growing businesses.',
                'monthly_price' => 99.99,  // Monthly subscription price
                'monthly_price_id' => "pri_01j4y5dj8jmh6zzbg65kr9pt38",  // Paddle ID for monthly
                'annual_price' => 959.90,  // Annual subscription price
                'annual_price_id' => "pri_01j7rb8jsp0hrw4mgxm1chp2yq",  // Paddle ID for annual
                'one_time_price' => null,
                'max_accounts' => 100,
                'billing_cycle' => 'monthly',
                'is_one_time' => 0,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Business',
                'product_id' => 'pro_01j4y4znakdsk6rpqz111v2aqn',
                'plan_id' => null,
                'slug' => 'business',
                'features' => 'Manage as many clients as you need\ Zero extra costs for adding accounts\ Expand without constraints\ No limits, no restrictions, just endless possibilities',
                'description' => 'Unleash your business full potential.',
                'monthly_price' => 199.99,  // Monthly subscription price
                'monthly_price_id' => "pri_01j4y51q2y31y5aepd313n4nae",  // Paddle ID for monthly
                'annual_price' => 1919.90,  // Annual subscription price
                'annual_price_id' => "pri_01j7rbsb579cvwzrvgsasbe1rd",  // Paddle ID for annual
                'one_time_price' => null,
                'max_accounts' => null,  // Unlimited accounts
                'billing_cycle' => 'monthly',
                'is_one_time' => 0,
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Lifetime',
                'product_id' => '',
                'plan_id' => "pri_01j4y56rbha1mrxrmd9qba3ryb",
                'slug' => 'lifetime',
                'features' => 'Unlimited accounts for life, One-time payment',
                'description' => 'A one-time investment for lifetime value.',
                'monthly_price' => null,  // Lifetime plan does not have monthly price
                'monthly_price_id' => null,
                'annual_price' => null,  // Lifetime plan does not have annual price
                'annual_price_id' => null,
                'one_time_price' => 2499.00,  // One-time payment
                'max_accounts' => null,  // Unlimited accounts
                'billing_cycle' => 'lifetime',
                'is_one_time' => 1,
            ],
        ]);


        // Dynamically retrieve plan IDs and insert additional account pricing
        $freePlanId = DB::table('plans')->where('slug', 'free')->value('id');
        $accountPlanId = DB::table('plans')->where('slug', 'account')->value('id');
        $agencyPlanId = DB::table('plans')->where('slug', 'agency')->value('id');

        DB::table('additional_account_pricings')->insert([
            [
                'id' => Str::uuid(),
                'price_id' => 'pri_01j4y59txkznzp4wfwzz5f4k8s',
                'plan_id' => $freePlanId,
                'price_per_account' => 100,  // $100 per additional account
            ],
            [
                'id' => Str::uuid(),
                'price_id' => 'pri_01j7rce4e5yzd0bvta4tga6qtg',
                'plan_id' => $accountPlanId,
                'price_per_account' => 50,   // $50 per additional account
            ],
            [
                'id' => Str::uuid(),
                'price_id' => 'pri_01j7rcf30y9pqyw91wcwka4db6',
                'plan_id' => $agencyPlanId,
                'price_per_account' => 25,   // $25 per additional account
            ]
        ]);


    }
}
