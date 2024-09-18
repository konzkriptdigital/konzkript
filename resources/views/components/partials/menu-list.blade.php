    <!-- Sidebar Primary -->
    <div class="flex flex-col items-stretch shrink-0 gap-5 py-5 w-[--tw-sidebar_primary-width]
        border md:border-none lg:border-none xl:border-none border-gray-300 dark:border-gray-200"
        id="sidebar_primary">
        <div class="items-center justify-center hidden lg:flex shrink-0" id="sidebar_primary_header">
            <a href="{{ route('dashboard') }}" wire:navigate>
                <x-application-logo class="block w-auto text-gray-800 fill-current h-9" />
            </a>
        </div>
        <div class="flex grow shrink-0" id="sidebar_primary_content">
            <div class="scrollable-y-hover grow gap-2.5 shrink-0 flex items-center flex-col" data-scrollable="true"
                data-scrollable-dependencies="#sidebar_primary_header,#sidebar_primary_footer"
                data-scrollable-height="auto" data-scrollable-offset="80px"
                data-scrollable-wrappers="#sidebar_primary_content">
                <a class="btn btn-icon btn-icon-xl rounded-md size-9 min-h-0 border border-transparent text-gray-600 hover:bg-light hover:text-primary hover:border-gray-200 [.active&amp;]:bg-light [.active&amp;]:text-primary [.active&amp;]:border-gray-200"
                    data-tooltip="" data-tooltip-placement="right" href="{{ route('dashboard') }}" wire:navigate>
                    <span class="menu-icon">
                        <x-icon-credit-card width="20" />
                    </span>
                    <span class="hidden tooltip" style="z-index: 100;">
                        Dashboard
                    </span>
                </a>

            </div>
        </div>
        <div class="flex flex-col items-center gap-5 shrink-0" id="sidebar_primary_footer">
            <div class="flex flex-col gap-1.5">
                <div class="dropdown" data-dropdown="true" data-dropdown-offset="10px, 15px"
                    data-dropdown-placement="right-end" data-dropdown-trigger="click|lg:click">
                    <button
                        class="relative min-h-0 text-gray-600 border border-transparent rounded-md dropdown-toggle btn btn-icon btn-icon-xl size-9 hover:bg-light hover:text-primary hover:border-gray-200 dropdown-open:bg-gray-200">
                        <span class="menu-icon">
                            <x-icon-credit-card width="20" />
                        </span>
                    </button>
                </div>
            </div>
            <x-mary-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button
                        class="inline-flex items-center text-sm font-medium p-[10px] leading-4 text-gray-500 transition duration-150 ease-in-out w-14 h-14 hover:text-gray-700 focus:outline-none">
                        @if (auth()->user()->avatar)
                            <img class="object-cover w-full h-full rounded-full" src="{{ asset('images/profile.jpg') }}"
                                alt="{{ auth()->user()->name }}" />
                        @else
                            @php
                                $names = [auth()->user()->name]; // Example for array of names
                                $initials = [];

                                foreach ($names as $name) {
                                    $nameParts = explode(' ', trim($name));
                                    $firstName = array_shift($nameParts);
                                    $lastName = array_pop($nameParts);
                                    $initials = mb_substr($firstName, 0, 1) . mb_substr($lastName, 0, 1);
                                }
                            @endphp
                            <span class="capitalize user--name-abbreviation">
                                {{ $initials }}
                            </span>
                        @endif

                    </button>
                </x-slot>

                <x-mary-menu-item title="{{ __('Profile') }}" link="{{ route('profile') }}" icon="o-envelope" />
                <x-mary-menu-item title="{{ __('Log Out') }}" wire:click="logout" icon="o-paper-airplane"
                    badge="78+" />

            </x-mary-dropdown>
        </div>
    </div>
    <!-- End of Sidebar Primary -->
    <!-- Sidebar Secondary -->
    @if (!Route::is('dashboard') && !Route::is('settings.checkout') && !Route::is('settings.pricing'))
        <x-partials.sub-sidebar />
    @endif
    <!-- End of Sidebar Secondary-->
