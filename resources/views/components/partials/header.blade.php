<header class="flex lg:hidden items-center fixed z-10 top-0 start-0 end-0 shrink-0 h-[--tw-header-height]" id="header">
    <!-- Container -->
    <div class="flex flex-wrap items-center justify-between gap-3 container-fluid">
        <a href="/metronic/tailwind/demo4/">
            <x-application-logo class="block w-auto text-gray-800 fill-current h-9" />
        </a>
        <div class="drawer w-[unset]">
            <input id="my-drawer" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content">
                <!-- Page content here -->
                <label for="my-drawer" class="btn btn-icon btn-light drawer-button btn-clear btn-sm -me-2">
                    <x-icon-credit-card width="20" />
                </label>
            </div>
            <div class="drawer-side">
                <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
                <div class="flex min-h-full bg-white text-base-content w-[--tw-sidebar-width]">
                    <!-- Sidebar content here -->
                    <x-partials.sidebar />
                </div>
                {{-- <div class="min-h-full p-4 menu bg-base-200 text-base-content w-80">
                    <!-- Sidebar content here -->
                    <li><a>Sidebar Item 1</a></li>
                    <li><a>Sidebar Item 2</a></li>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- End of Container -->
</header>
