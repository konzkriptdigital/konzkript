<?php

namespace App\Livewire\Pages;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

#[Layout('layouts.app')]
class Checkout extends Component
{
    public Plan $plan;
    // public $checkout;

    #[Computed]
    public function user ()
    {
        return Auth::user();
    }

    public function render()
    {
        // dd(auth()->user()->subscribe($this->plan->plan_id));
        // dd(auth()->user()->checkout("pri_01j4y56rbha1mrxrmd9qba3ryb"));
        return view('livewire.pages.checkout', [
            'checkout' => auth()->user()->subscribe('pri_01j7qtzy38nz08yzqw7vzj042v', 'default')
        ]);
    }
}
