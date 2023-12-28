<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])


        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/flowbite.min.css" rel="stylesheet" />

        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />

        <!-- Font -->
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&family=Roboto&display=swap" rel="stylesheet">

          <!-- Bootstrap -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>



        <style>
            /* Container for social links */
            div#social-links {
                margin: 0 auto;
                max-width: 500px;
                text-align: center; /* Center align the list */
            }

            /* Style for each list item */
            div#social-links ul {
                padding: 0; /* Remove default padding */
                list-style-type: none; /* Remove default list style */
            }

            div#social-links ul li {
                display: inline-block; /* Inline display for list items */
                margin: 5px; /* Add some space around each item */
            }

            /* Style for links */
            div#social-links ul li a {
                padding: 10px 15px; /* Adjust padding */
                border: 1px solid #ccc; /* Border color */
                border-radius: 5px; /* Rounded corners */
                margin: 1px; /* Margin around links */
                font-size: 24px; /* Adjust font size */
                color: #222; /* Text color */
                background-color: #eee; /* Lighter background color */
                text-decoration: none; /* Remove underline from links */
                transition: background-color 0.3s, color 0.3s; /* Smooth transition for hover effects */
            }

            /* Hover effect for links */
            div#social-links ul li a:hover {
                background-color: #ddd; /* Darker background on hover */
                color: #000; /* Darker text color on hover */
            }
        </style>


    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="py-8">
                @yield('content')
                {{ $slot }}
            </main>

            @include('layouts.footer')
        </div>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/datepicker.min.js"></script>
        <!-- Ajax -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    </body>
</html>
