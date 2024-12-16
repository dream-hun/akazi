<div class="min-w-0 flex-1 md:px-8 lg:px-0 xl:col-span-6">
    <div class="flex items-center px-6 py-4 md:mx-auto lg:mx-0 lg:max-w-none xl:px-0">
        <div class="w-full">
            <label for="search" class="sr-only">Search</label>
            <div class="relative" x-data="{ 
                    searchFocused: false,
                    init() {
                        this.$watch('searchFocused', value => {
                            if (!value) {
                                setTimeout(() => @this.hideResults(), 200)
                            }
                        })
                    }
                }" @click.away="searchFocused = false">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input wire:model.live.debounce.300ms="search" wire:keydown.arrow-down.prevent="incrementIndex" wire:keydown.arrow-up.prevent="decrementIndex" wire:keydown.enter.prevent="selectResult" wire:keydown.escape="hideResults" @focus="searchFocused = true" id="searchInput" @keydown.slash.window="$event.preventDefault(); $refs.searchInput.focus()" x-ref="searchInput" class="block w-full rounded-md border-0 bg-white py-1.5 pl-10 pr-3 text-blue-900 ring-1 ring-inset ring-blue-500 placeholder:text-blue-400 focus:ring-2 focus:ring-inset focus:ring-blue-500 sm:text-sm sm:leading-6" placeholder="Search jobs... (Press '/' to focus)" type="search" autocomplete="off">

                <div class="absolute mt-2 w-full overflow-hidden" x-show="searchFocused && $wire.showResults" x-cloak>

                    <div wire:loading class="p-4 bg-white shadow-sm ring-1 ring-blue-600 rounded-xl">
                        <div class="flex items-center justify-center">
                            <svg class="animate-spin h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span class="ml-2 text-sm text-gray-600">Searching...</span>
                        </div>
                    </div>

                    <div wire:loading.remove>
                        @if(count($results) > 0)
                        <ul role="list" class="divide-y divide-gray-100 overflow-hidden bg-white shadow-sm ring-1 ring-blue-600 rounded-xl">
                            @foreach($results as $index => $result)
                            <li class="relative flex justify-between gap-x-6 px-4 py-5 hover:bg-blue-50 {{ $index === $selectedIndex ? 'bg-blue-100' : '' }} transition-colors duration-150">
                                <div class="flex gap-x-4">
                                    @if($result->company?->logo)
                                    <img class="h-12 w-12 flex-none rounded-full bg-gray-50" src="{{ $result->company->getFirstMediaUrl('logo') }}" alt="{{ $result->company->name }}">
                                    @endif
                                    <div class="min-w-0 flex-auto">
                                        <p class="text-sm font-semibold leading-6 text-gray-900">
                                            <a href="{{ route('adverts.show', $result->slug) }}" class="hover:underline">
                                                <span class="absolute inset-x-0 -top-px bottom-0"></span>
                                                {!! preg_replace('/(' . preg_quote($search, '/') . ')/i', '<span class="bg-yellow-200">$1</span>', $result->title) !!}
                                            </a>
                                        </p>
                                        @if($result->company)
                                        <p class="mt-1 text-xs leading-5 text-gray-500">{{ $result->company->email }}</p>
                                        @endif
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        @elseif(strlen($search) > 2)
                        <div class="p-4 bg-white shadow-sm ring-1 ring-blue-600 rounded-xl">
                            <p class="text-sm text-gray-600 text-center">No results found for "{{ $search }}"</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
