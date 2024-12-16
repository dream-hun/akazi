<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Home-{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-white dark:bg-gray-900">
        <x-menu-component />
        <div class="py-12">

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="w-full sm:w-1/2">
                    <livewire:search />
                </div>
                <div class="py-6 w-full max-w-screen-xl mx-auto">
                    <div class="overflow-hidden rounded-md border border-blue-500 bg-blue-500 p-1">
                        <ul class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:flex lg:items-center gap-2 text-sm font-medium">
                            @foreach ($categories as $category)
                            <li class="py-1 px-1">
                                <a href="{{ route('category.show', $category->slug) }}" class="inline-flex w-full justify-between text-blue-400 bg-gray-100 cursor-pointer items-center gap-2 rounded-lg px-3 py-2 hover:bg-white hover:text-black hover:shadow" wire:navigate>
                                    <span class="truncate">{{ $category->name }}</span>
                                    <span class="rounded-full bg-green-300 px-2 py-0.5 text-xs font-semibold flex-shrink-0">
                                        {{ $category->adverts->count() }}
                                    </span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="space-y-4">
                    @foreach ($adverts as $advert)
                    <div class="mt-4">
                        <a href="{{ route('adverts.show', $advert->slug) }}" class="flex items-start sm:items-center bg-white p-3 sm:p-4 rounded-lg shadow-none border border-blue-500">
                            <div class="flex-shrink-0 mr-3 sm:mr-4">
                                <img src="{{ $advert->company->getFirstMediaUrl('logo') }}" alt="{{ $advert->company->name }}" class="w-40 h-20 object-fit">
                            </div>

                            <div class="flex-grow min-w-0">
                                <h4 class="text-lg sm:text-md font-semibold tracking-tight text-gray-900 dark:text-white">
                                    {{ $advert->title ?? '-' }}</h4>
                                <h5 class="text-blue-700 text-base sm:text-md font-bold tracking-tight py-1 sm:py-2">
                                    {{ $advert->company->name ?? '-' }}
                                </h5>
                                <div class="text-sm sm:text-base text-gray-900 space-y-1 sm:space-y-0">
                                    <div class="sm:inline-block">Location: {{ $advert->location ?? '-' }}</div>
                                    <div class="hidden sm:inline-block sm:mx-1">|</div>
                                    <div class="sm:inline-block">Published: {{ $advert->formattedPublish() ?? '-' }}</div>
                                    <div class="hidden sm:inline-block sm:mx-1">|</div>
                                    <div class="sm:inline-block">Deadline: {{ $advert->formattedDeadline() ?? '-' }}</div>
                                    <div class="hidden sm:inline-block sm:mx-1">|</div>
                                    <div class="sm:inline-block">Experience: {{ $advert->desired_experience ?? 'Not specified' }}</div>
                                </div>
                                <div class="mt-2 text-gray-600">
                                    <span class="inline-block px-2 py-1 text-xs font-semibold text-white bg-blue-500 rounded">
                                        {{ $advert->category->name ?? '-' }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <x-footer-component />
</body>

</html>
