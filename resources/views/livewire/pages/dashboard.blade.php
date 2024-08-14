<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\on;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Computed;

new #[Layout('layouts.app')] class extends Component
{
    #[Computed]
    public function user()
    {
        $user = auth()->user();
        if(! $user) {
            return null;
        }

        return $user;
    }

    #[Computed]
    public function company ()
    {
        if(! $this->user) {
            return null;
        }

        return $this->user->company;
    }

    #[Computed]
    public function ghlOauthUrl ()
    {
        $scope = config('services.ghl.scope');
        $clientId = config('services.ghl.client_id');
        $redirectUri = config('services.ghl.redirect');
        return "https://marketplace.gohighlevel.com/oauth/chooselocation?state={$this->user->id}&response_type=code&redirect_uri={$redirectUri}&client_id={$clientId}&scope={$scope}&loginWindowOpenMode=self";
    }

}; ?>
<div class="flex flex-col items-center justify-center h-full">
    <div class="relative z-10 flex flex-col gap-10 dashboard--content">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="dashboard--greetings">
            <h1>Hey Vincent 👋</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        </div>
        <div class="bg-white agency--container">
            <div class="flex flex-row justify-between w-full agency--header">
                <div class="agency--name">Konzript Digital</div>
                <div class="flex flex-row items-center agency--actions">
                    <x-mary-button link="{{ $this->ghlOauthUrl }}" external>
                        <x-icon-building-library width="16" class="width: 18px; height: 18px;" />
                        <span>{{ __('Add Account') }}</span>
                    </x-mary-button>
                    <x-mary-button link="{{ route('setting.pricing') }}" class="btn">
                        <x-icon-credit-card width="16" class="width: 18px; height: 18px;"/>
                        <span>{{ __('Billing') }}</span>
                    </x-mary-button>
                    <x-mary-button class="btn">
                        <x-icon-cogs-6-tooth width="16" class="width: 18px; height: 18px;"/>
                        <span>{{ __('Settings') }}</span>
                    </x-mary-button>
                </div>
            </div>
            @if ($this->company)
                @livewire('components.account-list', ['company' => $this->company, 'user' => $this->user])
            @endif
        </div>
    </div>
</div>
