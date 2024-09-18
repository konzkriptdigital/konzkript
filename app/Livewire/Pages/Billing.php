<?php

namespace App\Livewire\Pages;

use App\Models\Plan;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

#[Layout('layouts.app')]
class Billing extends Component
{
    public bool $showDrawer2 = false;


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
        return view('livewire.pages.billing');
    }
}
