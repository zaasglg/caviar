
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    {{-- <link rel="stylesheet" href="{{ asset('assets/fonts/avenir-next/stylesheet.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/fonts/Avenir/stylesheet.css') }}">
    <title>{{ $title ?? 'Caviar' }}</title>

    {{-- @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('build/assets/app-Y-4BAnIL.css') }}"> --}}

    <link rel="icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon" />

    @if (app()->environment('production'))
        <!--<link rel="stylesheet" href="{{ mix('build/assets/app.css') }}">-->
        <script src="{{ mix('build/assets/app.js') }}" defer></script>
    @else
        <!--@vite('resources/css/app.css')-->
        @vite('resources/js/app.js')
    @endif

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        clifford: '#da373d',
                    },
                    backgroundImage: {
                        'benefit-img': "url('https://caviar.com.kz/assets/images/benefit_bg.svg')",
                        'benefit-m-img': "url('https://caviar.com.kz/assets/images/benefit-m.svg')",
                        'footer-img': "url('https://caviar.com.kz/assets/images/footer-bg.jpg')",
                        'footer-m-img': "url('https://caviar.com.kz/assets/images/footer-m-bg.svg')",
                        'advantages': "url('https://caviar.com.kz/assets/images/footer_2_bg.png')"
                    },
                }
            }
        }
    </script>

</head>

<body>

    <livewire:components.header />

    {{ $slot }}

    <script>
        document.querySelectorAll('video[autoplay]').forEach(function(video) {
            video.play();
        });
    </script>

    <livewire:livewire-ui-modal />

    <x-toaster-hub />

</body>

</html>
