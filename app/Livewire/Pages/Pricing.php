<?php

namespace App\Livewire\Pages;

use App\Models\Plan;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Component;

#[Layout('layouts.setting')]
class Pricing extends Component
{
    #[Computed]
    public function user ()
    {
        return auth()->user();
    }

    #[Computed]
    public function plans ()
    {
        return Plan::all();
    }

    public function render()
    {
        return view('livewire.pages.pricing');
    }
}
