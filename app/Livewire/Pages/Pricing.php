<?php

namespace App\Livewire\Pages;

use App\Models\Company;
use App\Models\Plan;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Paddle\Subscription;

#[Layout('layouts.app')]
class Pricing extends Component
{
    public $is_monthly = true;
    public $planTiers = [
        'pro_01j7qtxdn40d0x91fkyhfh4ayg' => 1,
        'pro_01j4y5bpsy1z87q8qqyz056jfg' => 2,
        'pro_01j4y4znakdsk6rpqz111v2aqn' => 3
    ];


    public function switchMonthly ()
    {
        $this->is_monthly = !$this->is_monthly;
    }

    #[Computed]
    public function user ()
    {
        return Auth::user();
    }

    #[Computed]
    public function plans ()
    {
        return Plan::all();
    }

    public function getSubscriptions ()
    {
        return $this->user->company->subscriptions;
    }

    #[Computed]
    public function currentTier ()
    {
        $tier = null;

        $subscription = $this->user->company->subscription();
        foreach ($subscription['items'] as $item) {
            $product_id = $item['product_id'];

            // Check if this product_id exists in planTiers
            if (isset($this->planTiers[$product_id])) {
                $tier = $this->planTiers[$product_id];
                break; // Stop if we've found the matching tier
            }
        }

        return $tier;
        //
        // $item =
    }

    public function changePlan($price_id)
    {
        $this->user->company
            ->subscription()
            ->swap($price_id);
    }

    public function render()
    {
        return view('livewire.pages.pricing');
    }
}
