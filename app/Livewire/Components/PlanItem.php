<?php

namespace App\Livewire\Components;

use App\Models\Plan;
use App\Models\User;
use Livewire\Component;

class PlanItem extends Component
{
    public Plan $plan;
    public User $user;

    public function render()
    {
        return view('livewire.components.plan-item');
    }
}
