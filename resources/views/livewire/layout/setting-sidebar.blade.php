<?php

use Livewire\Volt\Component;

new class extends Component {
    //
}; ?>

<aside class="flex flex-col h-full p-4 bg-[#F6F6F4] sub--sidebar min-w-[220px] max-w-[220px]">
    <div class="relative w-56 my-4 sm:hidden">
        <input class="hidden peer" type="checkbox" name="select-1" id="select-1" />
        <label for="select-1"
            class="flex w-full p-2 px-3 text-sm text-gray-700 border rounded-lg cursor-pointer select-none ring-blue-700 peer-checked:ring">Accounts
        </label>
        <svg xmlns="http://www.w3.org/2000/svg"
            class="absolute right-0 h-4 ml-auto mr-5 transition pointer-events-none top-3 text-slate-700 peer-checked:rotate-180"
            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
        </svg>
        <ul
            class="flex-col overflow-hidden transition-all duration-300 rounded-b-lg shadow-md select-none max-h-0 peer-checked:max-h-56 peer-checked:py-3">
            <li class="px-3 py-2 text-sm cursor-pointer text-slate-600 hover:bg-blue-700 hover:text-white">Accounts</li>
            <li class="px-3 py-2 text-sm cursor-pointer text-slate-600 hover:bg-blue-700 hover:text-white">Team</li>
            <li class="px-3 py-2 text-sm cursor-pointer text-slate-600 hover:bg-blue-700 hover:text-white">Others</li>
        </ul>
    </div>
    <div class="hidden col-span-2 sm:block">
        <ul>
            <li
                class="px-2 py-2 mt-5 font-semibold transition border-l-2 border-transparent cursor-pointer hover:border-l-blue-700 hover:text-blue-700">
                Accounts</li>
            <li
                class="px-2 py-2 mt-5 font-semibold transition border-l-2 border-transparent cursor-pointer hover:border-l-blue-700 hover:text-blue-700">
                Users</li>
            <li
                class="px-2 py-2 mt-5 font-semibold transition border-l-2 border-transparent cursor-pointer hover:border-l-blue-700 hover:text-blue-700">
                Profile</li>
            <li
                class="px-2 py-2 mt-5 font-semibold transition border-l-2 border-transparent cursor-pointer hover:border-l-blue-700 hover:text-blue-700">
                Teams</li>
            <li
                class="px-2 py-2 mt-5 font-semibold text-blue-700 transition border-l-2 cursor-pointer border-l-blue-700 hover:border-l-blue-700 hover:text-blue-700">
                Billing</li>
            <li
                class="px-2 py-2 mt-5 font-semibold transition border-l-2 border-transparent cursor-pointer hover:border-l-blue-700 hover:text-blue-700">
                Notifications</li>
            <li
                class="px-2 py-2 mt-5 font-semibold transition border-l-2 border-transparent cursor-pointer hover:border-l-blue-700 hover:text-blue-700">
                Integrations</li>
        </ul>
    </div>
</aside>
