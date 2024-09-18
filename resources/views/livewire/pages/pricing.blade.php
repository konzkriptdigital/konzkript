<!-- Pricing -->
<div class="max-w-[105rem] h-full items-center justify-center flex flex-col px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">

    <!-- Hero -->
    <div class="relative w-full">
        <!-- Gradients -->
        <div aria-hidden="true" class="flex -z-[1] absolute -top-48 start-0">
            <div class="bg-purple-200 opacity-30 blur-3xl w-[1036px] h-[600px] dark:bg-purple-900 dark:opacity-20"></div>
        </div>
        <!-- End Gradients -->

        <div class="mx-auto pb-14">
            <!-- Title -->
            <div class="flex flex-col max-w-screen-lg gap-3 mx-auto mb-8 text-center lg:mb-12">
                <h2 class="mb-4 text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white">Fuel Your Growth with a Plan That Scales</h2>
                <p class="font-light text-gray-500 text-md dark:text-gray-400">Take control of your business&apos;s future with flexible pricing plans that empower you at every stage. Whether you&apos;re just starting out or managing a thriving agency, we&apos;ve designed each plan to give you the tools, features, and freedom to grow—without limits or hidden costs. </p>
                <p class="font-light text-gray-500 text-md dark:text-gray-400">Start for free or unlock unlimited potential with a plan that fits your ambitions. Wherever you are today, we&apos;ve got a plan to help you reach the next level. Your success is just a step away.</p>
            </div>
            <!-- End Title -->

            <!-- Switch -->

            <div class="flex items-center justify-center">
                <label class="text-sm text-gray-500 min-w-14 me-3 dark:text-neutral-400">Monthly</label>

                <x-mary-toggle wire:click="switchMonthly" class="bg-blue-700 hover:bg-blue-700 checked:bg-blue-700" />

                <label class="relative text-sm text-gray-500 min-w-14 ms-3 dark:text-neutral-400">
                    Annual
                    <span class="absolute -top-10 start-auto -end-28">
                        <span class="flex items-center">
                            <svg fill="currentColor" class="h-8 text-blue-700 w-14 dark:text-blue-800 -me-6" width="45" height="25" viewBox="0 0 45 25" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M43.2951 3.47877C43.8357 3.59191 44.3656 3.24541 44.4788 2.70484C44.5919 2.16427 44.2454 1.63433 43.7049 1.52119L43.2951 3.47877ZM4.63031 24.4936C4.90293 24.9739 5.51329 25.1423 5.99361 24.8697L13.8208 20.4272C14.3011 20.1546 14.4695 19.5443 14.1969 19.0639C13.9242 18.5836 13.3139 18.4152 12.8336 18.6879L5.87608 22.6367L1.92723 15.6792C1.65462 15.1989 1.04426 15.0305 0.563943 15.3031C0.0836291 15.5757 -0.0847477 16.1861 0.187863 16.6664L4.63031 24.4936ZM43.7049 1.52119C32.7389 -0.77401 23.9595 0.99522 17.3905 5.28788C10.8356 9.57127 6.58742 16.2977 4.53601 23.7341L6.46399 24.2659C8.41258 17.2023 12.4144 10.9287 18.4845 6.96211C24.5405 3.00476 32.7611 1.27399 43.2951 3.47877L43.7049 1.52119Z"
                                     class="" />
                            </svg>
                            <span
                                class="mt-3 inline-block whitespace-nowrap text-[11px] leading-5 font-semibold tracking-wide uppercase bg-blue-700 text-white rounded-full py-1 px-2.5">Save up to 20%</span>
                        </span>
                    </span>
                </label>
            </div>
            <!-- End Switch -->

            <button wire:click="clickMe('testing')" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 mt-auto">
                Test Swap
            </button>

            <!-- Grid -->
            <div class="grid grid-cols-1 gap-6 mt-12 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-4">

                @php
                    Log::info($this->user->company->subscriptions);
                @endphp

                @foreach ($this->plans as $plan)
                    @php
                        $targetTier = $this->planTiers[$plan->product_id] ?? null;
                    @endphp

                    @if ($plan->slug !== 'lifetime')
                        <div class="flex flex-col max-w-lg p-6 mx-auto text-center text-gray-900 bg-white border border-gray-100 rounded-lg shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
                            <h3 class="mb-4 text-2xl font-semibold">{{ $plan->name }}</h3>
                            <p class="font-light text-gray-500 sm:text-md dark:text-gray-400">{{ $plan->description }}</p>
                            <div class="flex items-baseline justify-center my-8">

                                @if($plan->slug !== 'free')

                                    @if ($this->is_monthly)
                                        <span class="mr-2 text-5xl font-extrabold">${{ $plan->slug === "free" ? 0 : $plan->monthly_price }}</span>
                                        <span class="text-gray-500 dark:text-gray-400">/month</span>
                                    @else
                                        <span class="mr-2 text-5xl font-extrabold">${{ $plan->slug === "free" ? 0 : $plan->annual_price }}</span>
                                        <span class="text-gray-500 dark:text-gray-400">/year</span>
                                    @endif
                                @else
                                    <span class="mr-2 text-5xl font-extrabold">Free</span>

                                @endif

                            </div>
                            <!-- List -->
                            <ul role="list" class="mb-8 space-y-4 text-left">

                                @php
                                    $features = explode('\\', $plan->features);
                                @endphp
                                @foreach ($features as $feature)
                                    <li class="flex items-start space-x-3">
                                        <!-- Icon -->
                                        <x-icon-check class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" />
                                        <span>{!! $feature !!}</span>
                                    </li>
                                @endforeach
                            </ul>


                            @php
                                $plan_pricing = $plan->annual_price_id;

                                if($this->is_monthly) {
                                    $plan_pricing = $plan->monthly_price_id;
                                }
                            @endphp

                            @if ($plan->slug === 'free')
                                @if (!$this->user->company->subscribed() || $this->user->company->subscribedToProduct('free'))
                                    <button type="button" class="text-white bg-blue-400 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 mt-auto cursor-not-allowed" disabled>
                                        Subscribed
                                    </button>
                                @else
                                    <button wire:clkick="changePlan('{{ $plan->plan_id }}')" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 mt-auto">
                                        Downgrade
                                    </button>
                                @endif
                            @else

                                @if ($this->user->company->subscribedToProduct($plan->product_id))
                                    <button type="button" class="text-white bg-red-700 hover:bg-red-800 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 mt-auto">
                                        Cancel Subscription
                                    </button>
                                @else


                                    <button wire:click="changePlan('{{ $plan_pricing }}')" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 mt-auto">
                                        @if (Route::is('settings.pricing'))
                                            @if ($this->currentTier && $targetTier)
                                                @if ($targetTier > $this->currentTier)
                                                    Upgrade
                                                @elseif ($targetTier < $this->currentTier)
                                                    Downgrade
                                                @endif
                                            @endif
                                        @else
                                            Get started
                                        @endif
                                    </button>
                                @endif
                            @endif
                        </div>
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
