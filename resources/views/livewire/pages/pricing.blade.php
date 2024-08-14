<!-- Pricing -->
<div class="max-w-[85rem] h-full items-center justify-center flex px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">

    <!-- Hero -->
    <div class="relative w-full">
        <!-- Gradients -->
        <div aria-hidden="true" class="flex -z-[1] absolute -top-48 start-0">
            <div class="bg-purple-200 opacity-30 blur-3xl w-[1036px] h-[600px] dark:bg-purple-900 dark:opacity-20"></div>
        </div>
        <!-- End Gradients -->

        <div class="max-w-[85rem] px-4 pt-10 sm:px-6 lg:px-8 lg:pt-14 lg:pb-14 mx-auto">
            <!-- Title -->
            <div class="max-w-2xl mx-auto mb-10 text-center">
                <h2
                    class="text-3xl font-bold leading-tight text-transparent md:text-4xl md:leading-tight lg:text-5xl lg:leading-tight bg-clip-text bg-gradient-to-r from-violet-600 to-fuchsia-700">
                    Simple, transparent pricing</h2>
                <p class="mt-2 text-gray-800 lg:text-lg dark:text-neutral-200">Whatever your status, our offers evolve
                    according to your needs.</p>
            </div>
            <!-- End Title -->

            <!-- Switch -->

            <div class="flex items-center justify-center">
                <label class="text-sm text-gray-500 min-w-14 me-3 dark:text-neutral-400">Monthly</label>

                <x-mary-toggle wire:model="" class="bg-[#8830D8] hover:bg-[#8830D8] checked:bg-[#8830D8]"/>

                <label class="relative text-sm text-gray-500 min-w-14 ms-3 dark:text-neutral-400">
                    Annual
                    <span class="absolute -top-10 start-auto -end-28">
                        <span class="flex items-center">
                            <svg class="h-8 w-14 -me-6" width="45" height="25" viewBox="0 0 45 25" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M43.2951 3.47877C43.8357 3.59191 44.3656 3.24541 44.4788 2.70484C44.5919 2.16427 44.2454 1.63433 43.7049 1.52119L43.2951 3.47877ZM4.63031 24.4936C4.90293 24.9739 5.51329 25.1423 5.99361 24.8697L13.8208 20.4272C14.3011 20.1546 14.4695 19.5443 14.1969 19.0639C13.9242 18.5836 13.3139 18.4152 12.8336 18.6879L5.87608 22.6367L1.92723 15.6792C1.65462 15.1989 1.04426 15.0305 0.563943 15.3031C0.0836291 15.5757 -0.0847477 16.1861 0.187863 16.6664L4.63031 24.4936ZM43.7049 1.52119C32.7389 -0.77401 23.9595 0.99522 17.3905 5.28788C10.8356 9.57127 6.58742 16.2977 4.53601 23.7341L6.46399 24.2659C8.41258 17.2023 12.4144 10.9287 18.4845 6.96211C24.5405 3.00476 32.7611 1.27399 43.2951 3.47877L43.7049 1.52119Z"
                                    fill="currentColor" class="fill-[#8830D8] dark:fill-[#8830D8]" />
                            </svg>
                            <span
                                class="mt-3 inline-block whitespace-nowrap text-[11px] leading-5 font-semibold tracking-wide uppercase bg-[#8830D8] text-white rounded-full py-1 px-2.5">Save
                                up to 10%</span>
                        </span>
                    </span>
                </label>
            </div>
            <!-- End Switch -->

            <!-- Grid -->
            <div
                class="flex flex-row items-center justify-center gap-6 mt-12">

                {{-- class="grid gap-3 mt-6 md:mt-12 sm:grid-cols-2 lg:grid-cols-4 md:gap-6 lg:gap-3 xl:gap-6 lg:items-center"> --}}
                {{-- class="grid items-center justify-center mt-6 md:mt-12 sm:grid-cols-2 lg:grid-cols-3 place-items-center"> --}}
                @foreach ($this->plans as $plan)
                    @if ($plan->slug !== 'lifetime')
                        @livewire('components.plan-item', ['plan' => $plan, 'user' => $this->user])
                    @endif
                @endforeach
            </div>
            <!-- End Grid -->
        </div>

        <div
            class="absolute top-1/2 start-1/2 -z-[1] transform -translate-y-1/2 -translate-x-1/2 w-[340px] h-[340px] border border-dashed border-violet-200 rounded-full dark:border-violet-900/60">
        </div>
        <div
            class="absolute top-1/2 start-1/2 -z-[1] transform -translate-y-1/2 -translate-x-1/2 w-[575px] h-[575px] border border-dashed border-violet-200 rounded-full opacity-80 dark:border-violet-900/60">
        </div>
        <div
            class="absolute top-1/2 start-1/2 -z-[1] transform -translate-y-1/2 -translate-x-1/2 w-[840px] h-[840px] border border-dashed border-violet-200 rounded-full opacity-60 dark:border-violet-900/60">
        </div>
        <div
            class="absolute top-1/2 start-1/2 -z-[1] transform -translate-y-1/2 -translate-x-1/2 w-[1080px] h-[1080px] border border-dashed border-violet-200 rounded-full opacity-40 dark:border-violet-900/60">
        </div>
    </div>
    <!-- End Hero -->
</div>
<!-- End Pricing -->
