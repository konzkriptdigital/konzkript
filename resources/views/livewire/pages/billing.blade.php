<div class="w-full h-full ">
    <style>
    .upgrade-bg {
        background-image: url('{{ asset("images/bg-14.png") }}');
    }
    </style>
    <div class="container-fluid flex flex-col p-[1.5rem] gap-5 lg:gap-7.5">
        <div class="hidden card glass--effect rounded-xl">
            <div
                class="flex items-center justify-between grow gap-5 p-5 bg-[center_right_-8rem] bg-no-repeat bg-[length:700px] upgrade-bg">
                <div class="flex items-center gap-4">
                    <div class="relative size-[50px] shrink-0">
                        <svg class="w-full h-full stroke-primary-clarity fill-primary-light" fill="none" height="48"
                            viewBox="0 0 44 48" width="44" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M16 2.4641C19.7128 0.320509 24.2872 0.320508 28 2.4641L37.6506 8.0359C41.3634 10.1795 43.6506 14.141 43.6506
               18.4282V29.5718C43.6506 33.859 41.3634 37.8205 37.6506 39.9641L28 45.5359C24.2872 47.6795 19.7128 47.6795 16 45.5359L6.34937
               39.9641C2.63655 37.8205 0.349365 33.859 0.349365 29.5718V18.4282C0.349365 14.141 2.63655 10.1795 6.34937 8.0359L16 2.4641Z"
                                fill="">
                            </path>
                            <path
                                d="M16.25 2.89711C19.8081 0.842838 24.1919 0.842837 27.75 2.89711L37.4006 8.46891C40.9587 10.5232 43.1506 14.3196 43.1506
               18.4282V29.5718C43.1506 33.6804 40.9587 37.4768 37.4006 39.5311L27.75 45.1029C24.1919 47.1572 19.8081 47.1572 16.25 45.1029L6.59937
               39.5311C3.04125 37.4768 0.849365 33.6803 0.849365 29.5718V18.4282C0.849365 14.3196 3.04125 10.5232 6.59937 8.46891L16.25 2.89711Z"
                                stroke="">
                            </path>
                        </svg>
                        <div class="absolute leading-none left-2/4 top-2/4 -translate-y-2/4 -translate-x-2/4">
                            <i class="ki-filled ki-cheque text-1.5xl text-primary">
                            </i>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center gap-2.5">
                            <a class="text-base font-semibold text-gray-900 hover:text-primary-active" href="#">
                                Upgrade your current plan to next Level
                            </a>
                            <!--
                            <span class="badge badge-sm badge-danger badge-outline">
                                Trial expires in 29 days
                            </span> -->
                        </div>
                        <div class="font-medium text-gray-700 text-2sm">
                            Enterprise Components.io is a website offering high-quality, advanced UI components designed
                            for developers, enhancing
                            <br>
                            efficiency and aesthetics in web and mobile app development.
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-1.5 shrink-0">
                    <a class="btn btn-sm btn-light btn-clear" href="#">
                        Cancel Trial
                    </a>
                    <a class="btn btn-sm btn-dark" href="#">
                        Upgrade Now
                    </a>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 xl:grid-cols-5 gap-5 lg:gap-7.5">
            <div class="col-span-3">
                <div class="flex flex-col gap-5 lg:gap-7.5">

                    <div class="card glass--effect">
                        <div class="flex-wrap items-center justify-between gap-5 card-header">
                            <div class="flex flex-col gap-1">
                                <div class="flex items-center gap-2.5">
                                    <h2 class="text-2xl font-semibold text-gray-900">
                                        Basic Plan
                                    </h2>
                                    <span class="badge badge-sm badge-success badge-outline">
                                        Monthly
                                    </span>
                                </div>
                                <p class="font-medium text-gray-600 text-2sm">
                                    Essential Features for Startups and Individuals
                                </p>
                            </div>
                            <div class="flex gap-2.5">
                                <a class="btn btn-sm btn-light" href="#">
                                    Cancel Plan
                                </a>
                                <a class="btn btn-sm btn-primary" href="javascript: void(0);" wire:click="$toggle('showDrawer2')" >
                                    Upgrade Plan
                                </a>
                            </div>
                        </div>
                        <div class="card-body lg:py-7.5">
                            <div class="flex flex-col items-stretch gap-5 lg:gap-7.5">
                                <div class="flex flex-wrap items-center gap-2 lg:gap-5">
                                    <div
                                        class="grid grid-cols-1 content-between gap-1.5 border border-dashed border-gray-400 shrink-0 rounded-md px-3.5 py-2 min-w-24 max-w-auto">
                                        <span class="font-semibold leading-none text-gray-900 text-md">
                                            $769.00
                                        </span>
                                        <span class="font-medium text-gray-600 text-2sm">
                                            Annual Total
                                        </span>
                                    </div>
                                    <div
                                        class="grid grid-cols-1 content-between gap-1.5 border border-dashed border-gray-400 shrink-0 rounded-md px-3.5 py-2 min-w-24 max-w-auto">
                                        <span class="font-semibold leading-none text-gray-900 text-md">
                                            $69.00
                                        </span>
                                        <span class="font-medium text-gray-600 text-2sm">
                                            Next Bill Amount
                                        </span>
                                    </div>
                                    <div
                                        class="grid grid-cols-1 content-between gap-1.5 border border-dashed border-gray-400 shrink-0 rounded-md px-3.5 py-2 min-w-24 max-w-auto">
                                        <span class="font-semibold leading-none text-gray-900 text-md">
                                            23 Aug, 24
                                        </span>
                                        <span class="font-medium text-gray-600 text-2sm">
                                            Next Billing Date
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card glass--effect">
                        <div class="card-header">
                            <h3 class="card-title">
                                Billing Details
                            </h3>
                            <button class="btn btn-light btn-sm">
                                Edit Billing
                            </button>
                        </div>
                        <div class="pt-4 pb-2 card-body">
                            <table class="table-auto">
                                <tbody>
                                    <tr>
                                        <td class="pb-5 text-sm font-medium text-gray-500 min-w-36 pe-6">
                                            Company Name
                                        </td>
                                        <td class="pb-5 text-sm font-medium text-gray-700">
                                            KeenThemes
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pb-5 text-sm font-medium text-gray-500 min-w-36 pe-6">
                                            Address
                                        </td>
                                        <td class="pb-5 text-sm font-medium text-gray-700">
                                            Keizersgracht 136, 1015 CW Amsterdam, Netherlands
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pb-5 text-sm font-medium text-gray-500 min-w-36 pe-6">
                                            Contact
                                        </td>
                                        <td class="pb-5 text-sm font-medium text-gray-700">
                                            Jason Tatum
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-2 flex flex-col gap-5 lg:gap-7.5">

                <div class="card grow glass--effect">
                    <div class="card-header">
                        <h3 class="card-title">
                            Latest Payment
                        </h3>
                        <button class="btn btn-light btn-sm">
                            <i class="ki-filled ki-exit-down">
                            </i>
                            Download PDF
                        </button>
                    </div>
                    <div class="pt-4 pb-3 card-body">
                        <table class="table-auto">
                            <tbody>
                                <tr>
                                    <td class="pb-5 text-sm font-medium text-gray-500 min-w-36 pe-6">
                                        Type of Plan
                                    </td>
                                    <td class="flex items-center gap-2.5 text-sm font-medium text-gray-700">
                                        Cloud One Enterprise
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pb-5 text-sm font-medium text-gray-500 min-w-36 pe-6">
                                        Payment Date
                                    </td>
                                    <td class="flex items-center gap-2.5 text-sm font-medium text-gray-700">
                                        6 Aug, 2024
                                    </td>
                                </tr>
                                <tr>
                                    <td class="pb-5 text-sm font-medium text-gray-500 min-w-36 pe-6">
                                        Total Payment:
                                    </td>
                                    <td class="flex items-center gap-2.5 text-sm font-medium text-gray-700">
                                        $24.00
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card glass--effect">
                    <div class="card-header">
                        <div class="flex flex-col">
                            <h3 class="card-title">
                                Invoices
                            </h3>
                            <p>Track and monitor your financial activity.</p>
                        </div>
                        <button class="btn btn-light btn-sm">
                            Export Invoices
                        </button>
                    </div>
                    <div class="pt-0 card-body">
                        <div class="flex flex-row gap-[0.375rem] py-5 border-b">
                            <div class="flex flex-col">
                                <h5 class="invoice--title text-[#263238] text-base font-semibold">INV-24 #MS-415646</h5>
                                <p class="text-sm font-normal">October 15, 2024</p>
                            </div>
                            <div class="flex items-center gap-12 ml-auto">
                                <label class="badge badge-success">
                                    Completed
                                </label>
                                <p class="text-sm font-medium">$49.00</p>
                                <button class="btn btn-light btn-sm">
                                    Export
                                </button>
                            </div>
                        </div>

                        <div class="flex flex-row gap-[0.375rem] py-5 border-b">
                            <div class="flex flex-col">
                                <h5 class="invoice--title text-[#263238] text-base font-semibold">INV-24 #MS-415646</h5>
                                <p class="text-sm font-normal">October 15, 2024</p>
                            </div>
                            <div class="flex items-center gap-12 ml-auto">
                                <label class="badge badge-success">
                                    Completed
                                </label>
                                <p class="text-sm font-medium">$49.00</p>
                                <button class="btn btn-light btn-sm">
                                    Export
                                </button>
                            </div>
                        </div>

                        <div class="flex flex-row gap-[0.375rem] py-5 border-b">
                            <div class="flex flex-col">
                                <h5 class="invoice--title text-[#263238] text-base font-semibold">INV-24 #MS-415646</h5>
                                <p class="text-sm font-normal">October 15, 2024</p>
                            </div>
                            <div class="flex items-center gap-12 ml-auto">
                                <label class="badge badge-success">
                                    Completed
                                </label>
                                <p class="text-sm font-medium">$49.00</p>
                                <button class="btn btn-light btn-sm">
                                    Export
                                </button>
                            </div>
                        </div>

                        <div class="flex flex-row gap-[0.375rem] py-5 border-b">
                            <div class="flex flex-col">
                                <h5 class="invoice--title text-[#263238] text-base font-semibold">INV-24 #MS-415646</h5>
                                <p class="text-sm font-normal">October 15, 2024</p>
                            </div>
                            <div class="flex items-center gap-12 ml-auto">
                                <label class="badge badge-success">
                                    Completed
                                </label>
                                <p class="text-sm font-medium">$49.00</p>
                                <button class="btn btn-light btn-sm">
                                    Export
                                </button>
                            </div>
                        </div>

                        <div class="flex flex-row gap-[0.375rem] py-5 border-b">
                            <div class="flex flex-col">
                                <h5 class="invoice--title text-[#263238] text-base font-semibold">INV-24 #MS-415646</h5>
                                <p class="text-sm font-normal">October 15, 2024</p>
                            </div>
                            <div class="flex items-center gap-12 ml-auto">
                                <label class="badge badge-success">
                                    Completed
                                </label>
                                <p class="text-sm font-medium">$49.00</p>
                                <button class="btn btn-light btn-sm">
                                    Export
                                </button>
                            </div>
                        </div>

                        <div class="flex flex-row gap-[0.375rem] py-5 border-b">
                            <div class="flex flex-col">
                                <h5 class="invoice--title text-[#263238] text-base font-semibold">INV-24 #MS-415646</h5>
                                <p class="text-sm font-normal">October 15, 2024</p>
                            </div>
                            <div class="flex items-center gap-12 ml-auto">
                                <label class="badge badge-success">
                                    Completed
                                </label>
                                <p class="text-sm font-medium">$49.00</p>
                                <button class="btn btn-light btn-sm">
                                    Export
                                </button>
                            </div>
                        </div>

                        <div class="flex flex-row gap-[0.375rem] py-5 border-b">
                            <div class="flex flex-col">
                                <h5 class="invoice--title text-[#263238] text-base font-semibold">INV-24 #MS-415646</h5>
                                <p class="text-sm font-normal">October 15, 2024</p>
                            </div>
                            <div class="flex items-center gap-12 ml-auto">
                                <label class="badge badge-success">
                                    Completed
                                </label>
                                <p class="text-sm font-medium">$49.00</p>
                                <button class="btn btn-light btn-sm">
                                    Export
                                </button>
                            </div>
                        </div>

                        <div class="flex flex-row gap-[0.375rem] py-5 border-b">
                            <div class="flex flex-col">
                                <h5 class="invoice--title text-[#263238] text-base font-semibold">INV-24 #MS-415646</h5>
                                <p class="text-sm font-normal">October 15, 2024</p>
                            </div>
                            <div class="flex items-center gap-12 ml-auto">
                                <label class="badge badge-success">
                                    Completed
                                </label>
                                <p class="text-sm font-medium">$49.00</p>
                                <button class="btn btn-light btn-sm">
                                    Export
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Right --}}
    <x-mary-drawer wire:model="showDrawer2" class="w-11/12 lg:w-1/3" right>

        <div aria-label="Tabs" role="tablist" aria-orientation="horizontal" class="flex flex-col w-full gap-6 "
            x-data="{ tab: '' }"
        >

            @foreach ($this->plans as $plan)
                @if ($plan->slug !== 'lifetime')
                    {{-- @livewire('components.plan-item', ['plan' => $plan, 'user' => $this->user, 'key' => $plan->id]) --}}
                    <livewire:components.plan-item :plan="$plan" :user="$this->user" :key="$plan->id" />

                    <div  x-show="tab == '{{ $plan->slug }}'" class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $plan->name }} <strong class="font-medium text-gray-800 dark:text-white">Profile tab's associated content</strong>. Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling.</p>
                    </div>
                @endif
            @endforeach
        </div>
    </x-mary-drawer>
</div>
