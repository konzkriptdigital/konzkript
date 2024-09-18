<div class="flex items-stretch grow shrink-0 justify-center ps-1.5 me-1.5" id="sidebar_secondary">
    <div class="scrollable-y-auto grow" data-scrollable="true" data-scrollable-height="auto"
        data-scrollable-offset="0px" data-scrollable-wrappers="#sidebar_secondary" >
        <!-- Sidebar Menu -->
        <x-mary-menu class="min-w-[200px]">
            <x-mary-menu-item title="Hello" />
            <x-mary-menu-item title="There" />

            {{-- Simple separator --}}
            <x-mary-menu-separator />

            {{-- Submenu --}}
            <x-mary-menu-sub title="Settings" icon="o-cog-6-tooth">
                <x-mary-menu-item title="Wifi" icon="o-wifi" />
                <x-mary-menu-item title="Archives" icon="o-archive-box" />
            </x-mary-menu-sub>

            {{-- Separator with title and icon --}}

            <x-mary-menu-item title="Wifi" icon="o-wifi" />
        </x-mary-menu>
        <!-- End of Sidebar Menu -->
    </div>
</div>
