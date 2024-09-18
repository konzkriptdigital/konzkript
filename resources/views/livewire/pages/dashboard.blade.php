<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\on;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Log;

new #[Layout('layouts.app')] class extends Component
{

    public $account_ids = [];
    public $ACTIVE_TAB = 'accounts';
    public string $search = "";
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

    public function activateAccount ()
    {
        $all_account_ids = $this->company->accounts()
            ->pluck('ghl_id')->toArray();

        // $not_selected_account_ids = array_diff($all_account_ids, $this->account_ids);

        $this->company->accounts()
            ->whereIn('ghl_id', $this->account_ids)
            ->update(['is_enabled' => true]);


        // Set is_enabled = false for the unchecked accounts
        $this->company->accounts()
            ->whereNotIn('ghl_id', $this->account_ids)
            ->update(['is_enabled' => false]);

        $this->dispatch('account-activated');
    }

    public function checkIds ()
    {
        logger($this->account_ids);
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
        <x-action-message class="p-4 text-sm text-green-800 rounded-lg bg-green-50" on="account-activated">
            {{ __('Your changes have been successfully applied.') }}
        </x-action-message>
        <div x-data="accountActions" class="bg-white agency--container" x-cloak>
            <div class="flex flex-row justify-between w-full agency--header">
                <div class="agency--name">Konzript Digital</div>
                <div class="flex flex-row items-center agency--actions">
                    <x-mary-button link="{{ $this->ghlOauthUrl }}" external>
                        <x-icon-building-library width="16" class="width: 18px; height: 18px;" />
                        <span class="hidden md:flex lg:flex xl:flex">{{ __('Add Account') }}</span>
                    </x-mary-button>
                    <x-mary-button link="{{ route('settings.billing') }}" class="btn">
                        <x-icon-credit-card width="16" class="width: 18px; height: 18px;"/>
                        <span class="hidden md:flex lg:flex xl:flex">{{ __('Billing') }}</span>
                    </x-mary-button>
                    <x-mary-button class="btn">
                        <x-icon-cogs-6-tooth width="16" class="width: 18px; height: 18px;"/>
                        <span class="hidden md:flex lg:flex xl:flex">{{ __('Settings') }}</span>
                    </x-mary-button>
                </div>
            </div>
            <div class="flex items-end justify-end account--actions py-[10px] px-[10px] gap-2">
                <div class="flex flex-row mr-auto account--tabs">
                    <div
                        @click="switchTab('accounts')"
                        :class="{'active': activeTab === 'accounts'}"
                        class="account--tab_item active">
                        <span>Accounts</span>
                    </div>
                    <div
                        @click="switchTab('waiting list')"
                        :class="{'active': activeTab === 'waiting list'}"
                        class="account--tab_item">
                        <span>Waiting List</span>
                    </div>
                </div>
                <div class="search--account">
                    <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                            <x-icon-search-lg class="w-4 h-4" />
                        </div>
                        <input
                            @input="searchAccount($event.target.value)"
                            type="search"
                            id="search"
                            class="block w-full p-1.5 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 bg-gray-50 focus:outline-none"
                            placeholder="Search Account" />
                    </div>
                </div>
                <div
                    x-show="!isWaitingTab"
                    class="flex flex-row gap-2">
                    <button
                        @click="showActivateActions()"
                        x-show="!isActivateAccount"
                        id="activate--account" type="button" class="inline-flex items-center gap-2 px-3 py-2 text-xs min-h-[34px] max-h-[34px] font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800">
                        <x-icon-home-2 class="w-4 h-4" />
                        <span>Activate Account<span>
                    </button>

                    <button
                        @click="selectDeselectAction()"
                        x-show="isActivateAccount && !isSelectAll"
                        id="select--all_account" type="button" class="inline-flex min-h-[34px] max-h-[34px] text-gray-900 bg-white border hover:bg-gray-100 font-medium rounded-lg text-xs gap-2 px-3 py-2">
                        <x-icon-plus class="w-4 h-4" />
                        <span>Select All<span>
                    </button>
                    <button
                        @click="selectDeselectAction()"
                        x-show="isActivateAccount && isSelectAll"
                        id="deselect--all_account" type="button" class="inline-flex min-h-[34px] max-h-[34px] text-white bg-gray-800 hover:bg-gray-900 font-medium rounded-lg text-xs gap-2 px-3 py-2">
                        <x-icon-minus class="w-4 h-4" />
                        <span>Deselet All<span>
                    </button>

                    <button
                        {{-- wire:click="checkIds" --}}
                        wire:click="activateAccount"
                        @click="saveActivateAction()"
                        x-show="isActivateAccount && isEdit"
                        id="save--activate_account" type="button" class="inline-flex items-center gap-2 px-3 py-2 text-xs min-h-[34px] max-h-[34px] font-medium text-center text-white bg-green-700 rounded-lg hover:bg-green-800">
                        <x-icon-x-close class="w-4 h-4" />
                        <span>Save<span>
                    </button>
                    <button
                        @click="cancelActivateAction()"
                        x-show="isActivateAccount"
                        id="cancel--activate_account" type="button" class="inline-flex items-center gap-2 px-3 py-2 text-xs min-h-[34px] max-h-[34px] font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800">
                        <x-icon-x-close class="w-4 h-4" />
                        <span>Cancel<span>
                    </button>
                </div>
            </div>
            @if ($this->company)
                @livewire('components.account-list', ['company' => $this->company, 'user' => $this->user, 'activeTab' => $this->ACTIVE_TAB, 'search' => $this->search])
            @endif
        </div>
    </div>
</div>
@assets
<style>
    .account--tabs {
        border-radius: 14px;
        border: 1px solid #E3E6E8;
        background: var(--Primary-Black-white, #FFF);
        box-shadow: 0px 2px 8px 0px rgba(0, 0, 0, 0.07);
        gap: 5px;
        padding: 4px;
        max-height: 36px;
    }
    .account--tabs > div {
        padding: 4px 8px;
        display: flex;
        align-items: center;
    }
    .account--tabs > div.active, .account--tabs > div:hover {
        border-radius: 9px;
        background: var(--Primary-Gray-100, #F3F4F6);
    }
    .account--tabs > div.active > span {
        color: var(--Primary-Gray-800, #1F2A37);
        font-weight: bold;
    }
    .account--tabs > div > span {
        color: #5D696F;
        font-family: Inter;
        font-size: 12px;
        font-style: normal;
        font-weight: 500;
        cursor: pointer;
    }
    .account--cards > .account--card.account--selected .activated--badge {
        display: flex;
        /* border-color: #004A77; */
        /* background: repeating-linear-gradient(135deg, #F2F4F7, #F2F4F7 2px, #FFFFFF 2px, #FFFFFF 10px); */
    }

    svg.activated--badge {
        position: absolute;
        top: 0;
        right: 0;
        transform: translate(6px, -6px);
        color: #1D4ED8;
        opacity: 1;
    }
    h3.account--result {
        grid-column: 1 / span 3;
        height: 150px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #101828;
        font-size: 20px;
        font-style: normal;
        font-weight: 600;
        line-height: 24px;
        pointer-events: none;
    }
</style>
@endassets
@script
<script>
    Alpine.data('accountActions', () => {
        return {
            isSelectAll: false,
            isActivateAccount: false,
            account_ids: $wire.entangle('account_ids'),
            activeTab: $wire.entangle('ACTIVE_TAB'),
            search: $wire.entangle('search'),
            isEdit: false,
            isWaitingTab: false,
            showActivateActions () {
                console.log('click')
                this.isActivateAccount = !this.isActivateAccount;
                if(this.isSelectAll) this.isSelectAll = false;
                this.checkActivatedAccounts();
            },
            selectDeselectAction () {
                const accounts = document.querySelectorAll('.account--card');
                this.isEdit = true;

                if(!this.isSelectAll) {
                    accounts.forEach(account => {
                        account.classList.add('account--selected');
                        const dataset = account.dataset;
                        const account_id = dataset.accountId;
                        const found = this.account_ids.find(id => id === account_id);
                        console.log('found => ', this.account_ids, account_id, found);
                        if(! found) {
                            this.account_ids.push(account_id);
                        }
                    });
                }
                else {
                    accounts.forEach(account => {
                        account.classList.remove('account--selected');
                        this.account_ids = [];
                    });
                }

                this.isSelectAll = !this.isSelectAll;
            },
            selectAccount (e, account_id) {
                if(! this.isActivateAccount) return;
                const currentTarget = e.currentTarget;
                if (currentTarget.classList.contains('account--selected')) {
                    currentTarget.classList.remove('account--selected');
                    const index = this.account_ids.indexOf(account_id);
                    if (index > -1) this.account_ids.splice(index, 1);

                } else {
                    currentTarget.classList.add('account--selected');
                    this.account_ids.push(account_id);
                }

                this.isEdit = true;
                this.checkActivatedAccounts();

            },
            switchTab (tab) {
                console.log(tab)
                this.activeTab = tab;
                $wire.dispatch('active-status', {state: tab});
                this.isWaitingTab = tab === 'waiting list' ? true : false;
            },
            searchAccount (search) {
                console.log(search)
                $wire.dispatch('search-account', {search: search});
            },
            saveActivateAction () {
                this.isActivateAccount = false;
                this.isEdit = false;
            },
            cancelActivateAction () {
                this.isActivateAccount = false;
            },
            checkActivatedAccounts () {
                if(document.querySelectorAll('.account--card.account--selected').length === document.querySelectorAll('.account--card').length) {
                    this.isSelectAll = true;
                }
                else {
                    this.isSelectAll = false;
                }
            },
            initAccountIds () {
                const accounts = document.querySelectorAll('.account--card');
                accounts.forEach(account => {
                    const dataset = account.dataset;
                    const account_id = dataset.accountId;
                    // if has class account--selected
                    if(account.classList.contains('account--selected')) {
                        this.account_ids.push(account_id);
                    }
                });
            },
            init () {
                this.initAccountIds();
                /* this.$watch('account_ids', (newValue, oldValue) => {
                    this.checkActivatedAccounts();
                }); */
            }
        }
    });
</script>
@endscript
