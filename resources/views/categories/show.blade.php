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
                        <ul
                            class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:flex lg:items-center gap-2 text-sm font-medium">
                            @foreach ($categories as $category)
                                <li class="py-1 px-1">
                                    <a href="{{ route('category.show', $category->slug) }}"
                                        class="inline-flex w-full justify-between text-blue-400 bg-gray-100 cursor-pointer items-center gap-2 rounded-lg px-3 py-2 hover:bg-white hover:text-black hover:shadow"
                                        wire:navigate>
                                        <span class="truncate">{{ $category->name }}</span>
                                        <span
                                            class="rounded-full bg-green-300 px-2 py-0.5 text-xs font-semibold flex-shrink-0">
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
                        <div class="bg-white p-4 rounded-lg shadow-md border border-blue-500 mt-4">
                            <a href="{{ route('adverts.show', $advert->slug) }}" class="flex items-center">

                                <img src="{{ $advert->company->getFirstMediaUrl('logo') }}"
                                    alt="{{ $advert->company->name }}"
                                    class="w-20 h-20 rounded-full object-contain mr-4">


                                <div class="flex-1">

                                    <div class="mb-4">
                                        <h3 class="text-lg font-semibold">{{ $advert->title ?? '-' }}</h3>
                                        <p class="text-sm text-gray-500">{{ $advert->company->name }}</p>
                                    </div>

                                    <div class="grid grid-cols-2 lg:grid-cols-4 items-center gap-2">
                                        <span
                                            class="px-2 py-1 text-xs font-semibold text-green-500 bg-green-50 rounded capitalize">
                                            Published at: {{ $advert->formattedPublish() ?? '-' }}
                                        </span>
                                        <span
                                            class="px-2 py-1 text-xs font-semibold text-blue-500 bg-blue-50 rounded capitalize">
                                            Deadline: {{ $advert->formattedDeadline() ?? '-' }}
                                        </span>
                                        <span
                                            class="px-2 py-1 text-xs font-semibold text-yellow-500 bg-yellow-50 rounded capitalize">
                                            Location: {{ $advert->location ?? '-' }}
                                        </span>
                                        <span
                                            class="px-2 py-1 text-xs font-semibold text-purple-500 bg-purple-50 rounded capitalize">
                                            Experience: {{ $advert->desired_experience ?? 'Not specified' }}
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
