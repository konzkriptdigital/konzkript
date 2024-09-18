<?php

use App\Livewire\Forms\CustomLoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public CustomLoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $validated = $this->validate();

        $this->form->customAuthenticationEmailOnly();

        // Session::regenerate();

        $this->redirect(route('verify.code', ['email' => $this->form->email]));
        // $this->redirectIntended(default: route('verify.code', ['email' => $this->form->email], absolute: false), navigate: true);
        // $this->redirect(default: route('verify.code', ['email' => $this->form->email], absolute: false), navigate: true);
    }
}; ?>

<div class="max-w-[300px] mx-auto">
    <x-guest.logo :header="'We\'ll sign you in or create an account if you don\'t have one yet.'" />

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login">
        <!-- Email Address -->
        <div>
            <x-mary-input id="email" wire:model="form.email" class="block w-full h-10 mt-1 border-[#2b2a351f] text-sm " type="email" name="email" required autofocus autocomplete="username" placeholder="Work Email"/>
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <x-mary-button type="submit" class="w-full no-animation bg-violet-500 hover:bg-violet-400 h-[40px] min-h-[40px] border-0 mt-2 disabled:bg-violet-300 " >
            <span class="text-sm text-white ms-2">{{ __('Continue with Email') }}</span>
        </x-mary-button>

        <x-mary-button link="{{ route('google.oauth') }}" no-wire-navigate class="w-full no-animation bg-white hover:bg-[#F6F6F6] hover:border-[#2b2a351f] h-[40px] min-h-[40px] border-[#2b2a351f] mt-8">
            <x-icon-google width="20"/>
            <span class="text-sm text-gray-600 ms-2">{{ __('Continue with Google') }}</span>
        </x-mary-button>

        <x-mary-button class="w-full no-animation bg-white hover:bg-[#F6F6F6] hover:border-[#2b2a351f] h-[40px] min-h-[40px] border-[#2b2a351f] mt-2">
            <x-icon-facebook width="20"/>
            <span class="text-sm text-gray-600 ms-2">{{ __('Continue with Facebook') }}</span>
        </x-mary-button>

        <x-guest.footer />
    </form>
</div>
