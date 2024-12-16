<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $company->name }} - {{ config('app.name', 'Laravel') }}</title>
    <meta
        description="Akazi kose company that is located in Kigali Rwanda. It helps in finding jobs,tenders,consultancy,training and internships.">
    <meta
        keywords="Home,Rwanda,Kigali,akazi kose,jobs,job,online job,online jobs,jobs online,consultancy,training,training online,internships">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <x-menu-component />

        <div class="py-6 sm:py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @foreach ($adverts as $advert)
                    <div class="bg-white p-4 rounded-lg shadow-md border border-blue-500 mt-4">
                        <a href="{{ route('adverts.show', $advert->slug) }}" class="flex items-center">

                            <img src="{{ $advert->company->getFirstMediaUrl('logo') }}"
                                alt="{{ $advert->company->name }}" class="w-20 h-20 rounded-full object-contain mr-4">


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
    <x-footer-component />
</body>

</html>
