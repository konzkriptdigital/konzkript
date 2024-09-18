<?php

use Livewire\Volt\Component;

new class extends Component {
    public $category = '';
    public $accounts = [];
    public $test = 'test';

    public function mount($accounts)
    {
        logger($accounts);
        $this->accounts = $accounts;
    }
}; ?>

<style>
    .top-100 {
        top: 100%
    }

    .bottom-100 {
        bottom: 100%
    }

    .max-h-select {
        max-height: 300px;
    }
</style>
<div class="flex flex-col items-center">
    <div class="flex flex-col items-center w-full h-64 md:w-1/2">
        <div class="w-full px-4">
            <div x-data="selectConfigs({ accounts: $wire.accounts})" x-init="fetchOptions()" class="relative flex flex-col items-center">
                <div class="w-full">
                    <div @click.away="close()" class="flex p-1 my-2 bg-white border border-gray-200 rounded">
                        <input x-model="filter" x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                            @mousedown="open()" @keydown.enter.stop.prevent="selectOption()"
                            @keydown.arrow-up.prevent="focusPrevOption()"
                            @keydown.arrow-down.prevent="focusNextOption()"
                            class="w-full p-1 px-2 text-gray-800 outline-none appearance-none">
                        <div class="flex items-center w-8 py-1 pl-2 pr-1 text-gray-300 border-l border-gray-200">
                            <button @click="toggle()"
                                class="w-6 h-6 text-gray-600 outline-none cursor-pointer focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <polyline x-show="!isOpen()" points="18 15 12 20 6 15"></polyline>
                                    <polyline x-show="isOpen()" points="18 15 12 9 6 15"></polyline>
                                </svg>

                            </button>
                        </div>
                    </div>
                </div>
                <div x-show="isOpen()"
                    class="absolute z-40 w-full overflow-y-auto bg-white rounded shadow top-100 lef-0 max-h-select">
                    <div class="flex flex-col w-full">
                        <template x-for="(option, index) in filteredOptions()" :key="index">
                            <div @click="onOptionClick(index)" :class="classOption(option.login.uuid, index)"
                                :aria-selected="focusedOptionIndex === index">
                                <div
                                    class="relative flex items-center w-full p-2 pl-2 border-l-2 border-transparent hover:border-teal-100">
                                    <div class="flex flex-col items-center w-6">
                                        <div
                                            class="relative flex items-center justify-center w-4 w-5 h-4 h-5 m-1 mt-1 mr-2 bg-orange-500 rounded-full ">
                                            <img class="rounded-full" alt="A"
                                                x-bind:src="option.picture.thumbnail"> </div>
                                    </div>
                                    <div class="flex items-center w-full">
                                        <div class="mx-2 -mt-1"><span
                                                x-text="option.name.first + ' ' + option.name.last"></span>
                                            <div class="w-full -mt-1 text-xs font-normal text-gray-500 normal-case truncate"
                                                x-text="option.email"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@script
<script>
    Alpine.data('selectConfigs', (params) => {
        console.log('params =>>> ', params.accounts)
        return {
            filter: '',
            show: false,
            selected: null,
            focusedOptionIndex: null,
            options: null,
            test: $wire.test,
            close() {
                this.show = false;
                this.filter = this.selectedName();
                this.focusedOptionIndex = this.selected ? this.focusedOptionIndex : null;
            },
            open() {
                this.show = true;
                this.filter = '';
            },
            toggle() {
                if (this.show) {
                    this.close();
                } else {
                    this.open()
                }
            },
            isOpen() {
                return this.show === true
            },
            selectedName() {
                return this.selected ? this.selected.name.first + ' ' + this.selected.name.last : this.filter;
            },
            classOption(id, index) {
                const isSelected = this.selected ? (id == this.selected.login.uuid) : false;
                const isFocused = (index == this.focusedOptionIndex);
                return {
                    'cursor-pointer w-full border-gray-100 border-b hover:bg-blue-50': true,
                    'bg-blue-100': isSelected,
                    'bg-blue-50': isFocused
                };
            },
            fetchOptions() {
                console.log('accounts =>> ', this.test)
                fetch('https://randomuser.me/api/?results=5')
                    .then(response => response.json())
                    .then(data => {
                        console.log('https://randomuser.me/api/?results=5 =>>> ', data);
                        this.options = data
                    });
            },
            filteredOptions() {
                return this.options ?
                    this.options.results.filter(option => {
                        return (option.name.first.toLowerCase().indexOf(this.filter) > -1) ||
                            (option.name.last.toLowerCase().indexOf(this.filter) > -1) ||
                            (option.email.toLowerCase().indexOf(this.filter) > -1)
                    }) :
                    {}
            },
            onOptionClick(index) {
                this.focusedOptionIndex = index;
                this.selectOption();
            },
            selectOption() {
                if (!this.isOpen()) {
                    return;
                }
                this.focusedOptionIndex = this.focusedOptionIndex ?? 0;
                const selected = this.filteredOptions()[this.focusedOptionIndex]
                if (this.selected && this.selected.login.uuid == selected.login.uuid) {
                    this.filter = '';
                    this.selected = null;
                } else {
                    this.selected = selected;
                    this.filter = this.selectedName();
                }
                this.close();
            },
            focusPrevOption() {
                if (!this.isOpen()) {
                    return;
                }
                const optionsNum = Object.keys(this.filteredOptions()).length - 1;
                if (this.focusedOptionIndex > 0 && this.focusedOptionIndex <= optionsNum) {
                    this.focusedOptionIndex--;
                } else if (this.focusedOptionIndex == 0) {
                    this.focusedOptionIndex = optionsNum;
                }
            },
            focusNextOption() {
                const optionsNum = Object.keys(this.filteredOptions()).length - 1;
                if (!this.isOpen()) {
                    this.open();
                }
                if (this.focusedOptionIndex == null || this.focusedOptionIndex == optionsNum) {
                    this.focusedOptionIndex = 0;
                } else if (this.focusedOptionIndex >= 0 && this.focusedOptionIndex < optionsNum) {
                    this.focusedOptionIndex++;
                }
            }
        }
    });
</script>
@endscript
