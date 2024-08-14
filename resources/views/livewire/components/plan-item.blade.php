<!-- Card -->
<div
    class=" bg-white text-center rounded-2xl min-w-[290px] max-w-[290px]
    @if ($plan->is_featured) border-2 shadow-xl border-violet-900 rounded-2xl md:p-8 dark:bg-neutral-900 dark:border-violet-700
    @else border border-gray-200 md:p-8 dark:bg-neutral-900 dark:border-neutral-800 @endif
">

    @if ($plan->is_featured)
        <p class="mb-3"><span
                class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-lg text-xs uppercase font-semibold bg-violet-100 text-violet-800 dark:bg-violet-900 dark:text-white">Most
                popular</span></p>
    @endif

    <h4 class="text-lg font-medium text-gray-800 dark:text-neutral-200">{{ $plan->name }}</h4>
    <span
        class="flex items-center justify-center mt-5 text-3xl font-bold text-gray-800 md:text-4xl xl:text-5xl dark:text-neutral-200">{{ $plan->price === 0 ? 'Free' : "$" . $plan->price }}</span>
    <p class="mt-2 text-sm text-gray-500 dark:text-neutral-500">{{ $plan->description }}</p>

    <ul class="mt-7 space-y-2.5 text-sm">
        <li class="flex gap-x-2">
            <svg class="shrink-0 mt-0.5 size-4 text-violet-900 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12" />
            </svg>
            <span class="text-gray-800 dark:text-neutral-400">
                1 user
            </span>
        </li>

        <li class="flex gap-x-2">
            <svg class="shrink-0 mt-0.5 size-4 text-violet-900 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12" />
            </svg>
            <span class="text-gray-800 dark:text-neutral-400">
                Plan features
            </span>
        </li>

        <li class="flex gap-x-2">
            <svg class="shrink-0 mt-0.5 size-4 text-violet-900 dark:text-blue-500" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round">
                <polyline points="20 6 9 17 4 12" />
            </svg>
            <span class="text-gray-800 dark:text-neutral-400">
                Product support
            </span>
        </li>
    </ul>

    <a href="{{ route('setting.checkout', $plan->id) }}" type="button" @if (!$user->subscribed() && $plan->slug === 'free') disabled="disabled" @endif
        class="inline-flex items-center justify-center px-4 py-3 mt-5 text-sm font-medium hover:bg-violet-700 hover:text-white
        @if ($plan->is_featured) text-white bg-blue-600 border border-transparent rounded-lg gap-x-2 bg-violet-600 focus:outline-none focus:bg-violet-700 disabled:opacity-50 disabled:pointer-events-none
        @else
            border rounded-lg gap-x-2 border-violet-600 text-violet-600 hover:border-violet-500 hover:text-violet-500 focus:outline-none focus:border-violet-500 focus:text-violet-500 disabled:opacity-50 disabled:pointer-events-none dark:border-violet-500 dark:text-violet-500 dark:hover:text-violet-400 dark:hover:border-violet-400 dark:focus:text-violet-400 dark:focus:border-violet-400 @endif
    ">
        @if (!$user->subscribed() && $plan->slug === 'free')
            Subscribed
        @else
            Upgrade
        @endif


    </a>
</div>
<!-- End Card -->
