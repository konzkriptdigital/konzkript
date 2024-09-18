<?php

namespace App\Livewire\Components;

use App\Models\Account;
use App\Models\Company;
use App\Models\User;
use App\Traits\AbbreviatesStrings;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class AccountList extends Component
{

    use AbbreviatesStrings, WithPagination;

    public Company $company;
    public User $user;
    public $limit = 5;
    public $offset = 0;
    public $loadedAccounts = [];
    public int $on_page = 5;
    public $activeTab;
    public string $search = "";

    /* public function getListeners()
    {
        return [
            "echo-private:accounts.{$this->company->id},AccountsEvent" => 'onAccountsEvent',
        ];
    } */

    public function loadMore ($is_flag = false)
    {
        $is_waiting = $this->activeTab === 'waiting list' ? 1 : 0;
        $newAccounts = Account::query()
            ->where('company_id', $this->company->id)
            ->where('name', 'like', '%' . $this->search . '%')
            ->where('is_waiting', $is_waiting)
            ->offset($this->offset)
            ->limit($this->limit)
            ->get();

        if(empty($this->loadedAccounts)) {
            $this->loadedAccounts = array_merge($this->loadedAccounts, $newAccounts->toArray());
        }
        else {
            $this->loadedAccounts = $newAccounts->toArray();
        }

        if(! $is_flag) {
            $this->offset += $this->limit;
        }
    }

    #[On('echo-private:accounts.{company.id},AccountsEvent')]
    public function onAccountsEvent($event)
    {
        // logger($event);
        $account = $event['account'];
        $accounts = $this->loadedAccounts;
        $exists = !empty(array_filter($accounts, function ($item) use ($account) {
            return $item['ghl_id'] === $account['ghl_id'];
        }));

        if(!$exists) {
            $this->loadedAccounts [] = $account;
        }
    }

    public function mount()
    {
        $this->loadMore();
    }

    #[On('active-status')]
    public function onActiveTab ($state)
    {
        $this->activeTab = $state;
        $this->offset = 0;
        $this->loadMore(true);
    }

    #[On('search-account')]
    public function searchAccount ($search)
    {
        $this->search = $search;
        $this->offset = 0;
        $this->loadMore(true);
    }

    public function render()
    {
        return view('livewire.components.account-list', [
            'accounts' => $this->loadedAccounts
        ]);
    }
}
