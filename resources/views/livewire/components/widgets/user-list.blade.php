<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Company;
use App\Models\Account;
use Livewire\Attributes\Url;
use Livewire\Attributes\Computed;
use App\Traits\AbbreviatesStrings;
use Carbon\Carbon;
use App\Traits\GenerateColors;
use Livewire\Attributes\On;
use Livewire\Attributes\Locked;

new #[Layout('layouts.iframe')] class extends Component
{
    use WithPagination, AbbreviatesStrings, GenerateColors;

    #[Locked]
    #[Url]
    public Company $company; // Current company

    #[Locked]
    #[Url]
    public User $user; // Current user

    public int $limit = 50; // Limit of users
    public $search_user_name = ""; // Search user name
    public $account_id = null; // Selected account id

    #[Locked]
    #[Computed]
    public function users ()
    {
        $users = $this->company->users()
            ->orderBy('name');

        if (Str::length($this->search_user_name) >= 1) {
            $users->where('name', 'like', '%' . $this->search_user_name . '%');
        }

        // Filter users related to a single account
        if (!is_null($this->account_id)) {
            $users->whereHas('accounts', function ($query) {
                $query->where('accounts.id', $this->account_id);
            });
        }


        $users->limit($this->limit);
        $results = $users->get();
        return $results;
    }

    public function queryResult () {}

    #[Locked]
    #[Computed]
    public function accounts ()
    {
        $show_only = ['name', 'id'];

        if($this->user->data['roles']['type'] === 'agency') {

            $selected_account_id = $this->company
                ->accounts()
                ->where('id', $this->account_id)
                ->get($show_only);

            return $this->company->accounts()
                ->orderBy('name')
                ->get($show_only)
                ->merge($selected_account_id);
        }


        $selected_account_id = $this->company
            ->accounts()
            ->where('id', $this->account_id)
            ->get($show_only);

        return $this->user->accounts()
            ->orderBy('name')
            ->get($show_only)
            ->merge($selected_account_id);
    }

    public function loadMore ()
    {
        $this->dispatch('user-list-component-height-set');
        $this->limit += 1;
    }
}; ?>


{{-- /* #[On('echo-private:user.{user.id},UserStatusEvent')] */ --}}
<div id="dropdownNotification"
    class="z-20 block w-full h-full max-h-[500px] bg-white divide-y divide-gray-100 shadow dark:bg-gray-800 dark:divide-gray-700"
    style=""
    data-popper-placement="bottom"
    >

    <div class="p-3 user--list_action">
        <x-mary-input label="Name" placeholder="Search user name" wire:model.live.debounce.500ms="search_user_name" icon="o-user" />
        {{-- @livewire('components.partials.select-input', ['accounts' => $this->accounts]) --}}
        <x-mary-choices-offline
            label="Filter by Location"
            wire:model="account_id"
            :options="$this->accounts"
            single
            @change-selection="$wire.queryResult()"
            searchable />
    </div>

    <div class="divide-y divide-gray-100 dark:divide-gray-700">

        @if ($this->users)

            @foreach ($this->users as $userData)
                @if ($user->ghl_id !== $userData->ghl_id)

                    <div class="flex items-start gap-3 px-4 py-3 user--item hover:bg-gray-100 dark:hover:bg-gray-700"
                        data-id="{{ $userData->ghl_id }}"
                        wire:key="{{ $userData->ghl_id }}">
                        <div class="flex-shrink-0 avatar--container">
                            @if (isset($userData->avatar))
                                <img src="{{ $userData->avatar }}" class="rounded-full" alt="{{ $userData->name }} Avatar">
                            @else
                                <span style="background-color: {{ $userData->profile_color ? $userData->profile_color : $this->generateColor() }};" class="text-white rounded-full">{{ $this->abbreviate($userData->name) }}</span>
                            @endif
                        </div>
                        <div class="flex flex-col items-start justify-start user--info">
                            <h5>{{ $userData->name }}</h5>
                            <p>{{ $userData->email }}</p>

                            @if ($userData->status)
                                @if ($userData->status['is_online'] == 1)
                                    <label class="rounded-[7px] bg-[#A6F4C5] text-[#054F31] user--status">Active</label>
                                @else
                                    <div class="text-xs text-blue-600 dark:text-blue-500 user--status">Last seen {{ Carbon::parse($userData->status['last_seen_at'])->diffForHumans() }}</div>
                                @endif
                            @else
                                <div class="text-xs text-blue-600 dark:text-blue-500 user--status">Haven't logged yet.</div>
                            @endif
                        </div>
                        <div class="flex flex-row gap-2 user--type">
                            @if ($this->user->data['roles']['type'] === 'agency')
                                <label class="rounded-[7px] bg-[#B9E6FE] text-[#0B4A6F]">{{ $userData->data['roles']['type'] }}</label>
                            @endif
                            <label class="rounded-[7px] bg-[#047481] text-[#AFECEF]">{{ $userData->data['roles']['role'] }}</label>
                        </div>
                    </div>
                @endif
            @endforeach
            @if ($this->users->count() >= $this->limit)
                <div x-intersect.full="$wire.loadMore()" class="border-4 h-[1px]"></div>
            @endif
        @endif
    </div>

</div>

<style>
    .avatar--container > * {
        border-radius: 11px;
        padding: 7px 6px;
    }

    .avatar--container > span {
        font-family: "Inter";
        font-size: 10px;
        font-style: normal;
        font-weight: 600;
        line-height: 16px;
    }

    .user--item .avatar--container > * {
        min-width: 30px;
        min-height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .user--info h5 {
        color: #101828;
        font-size: 14px;
        font-style: normal;
        font-weight: bold;
        line-height: 14px;
    }
    .user--info p {
        color: #667085;
        font-family: Inter;
        font-size: 14px;
        font-style: normal;
        font-weight: 400;
        line-height: 20px;
    }
    .user--type label, .user--info label {
        padding: 2px 8px;
        font-size: 10px;
        font-style: normal;
        font-weight: 600;
        line-height: 18px;
        text-transform: uppercase;
    }
    .user--type {
        margin: auto 0 auto auto;
    }

    .account--info {
        background: var(--Primary-Gray-50, #F9FAFB);
        padding: 10px 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .account--info h4 {
        color: #101828;
        font-size: 14px;
        font-style: normal;
        font-weight: bold;
        line-height: 14px;
    }

    .account--info span {
        color: #667085;
        font-size: 12px;
        font-style: normal;
        font-weight: 400;
        line-height: 20px;
    }

    .account--container {
        border-bottom: 1px solid var(--Primary-Gray-200, #E5E7EB);
    }
</style>


@script
<script>
    Livewire.on('user-list-component-height-set', () => {
        setTimeout(() => {
            userList.setUserListComponentHeight();
        });
    });
</script>
@endscript
