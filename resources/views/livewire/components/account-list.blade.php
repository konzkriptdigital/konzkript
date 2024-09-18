<div class="account--cards">
    @if ($accounts)
        @foreach ($accounts as $account)
            {{-- @livewire('component.account-item', ['account' => $account, 'key' => $account['id']]) --}}

            <div class="account--card flex flex-row gap-[10px] {{ $account['is_enabled'] ? 'account--selected' : '' }}"
                @click="selectAccount($event, '{{ $account['data']['id'] }}')"
                data-account-id="{{ $account['data']['id'] }}"
                :key="{{ $account['data']['id'] }}">
                <div class="relative account--profile">
                    @if(isset($account['data']['logoUrl']))
                        <img src="{{ $account['data']['logoUrl'] }}" alt="{{ $account['data']['name'] }}" class="account--profile-image" />
                    @else
                        <div class="account--profile-placeholder">
                            {{ $this->abbreviate($account['data']['name']) }}
                        </div>
                    @endif
                    <x-icon-verify class="hidden activated--badge"/>
                </div>
                <div class="flex flex-col account--content">
                    <div class="account--name">{{ $account['data']['name'] }}</div>
                    <div class="account--location-id">{{ $account['data']['address'] ?? '' }}</div>
                </div>
            </div>

        @endforeach
        {{-- <button wire:click="loadMore" class="btn">Load More</button> --}}
    @else
        <h3 class="account--result">No Account Found</h3>
    @endif
</div>
