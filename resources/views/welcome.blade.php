<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />



    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/flowbite.min.css" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&family=Roboto&display=swap" rel="stylesheet">



    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-white bg-gray-100 dark:bg-gray-900">

        <!-- Navigation bar -->
        <nav x-data="{ open: true }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">

                                <!-- Auth::check() ? (Auth::user()->role == 'student' ? route('dashboard') : route('employer.dashboard')) :  -->

                                <a href="{{ route('welcome') }}">
                                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                                </a>
                            </div>

                            <!-- Dashboard -->
                        @auth
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <x-nav-link :href="Auth::check() ? (Auth::user()->type == 'student' ? route('student.dashboard') : route('employer.dashboard')) : null" :active="request()->routeIs('dashboard')">
                                    {{ __('Dashboard') }}
                                </x-nav-link>
                            </div>
                        @endauth
                            <!-- Job List -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <x-nav-link :href="route('job.list')" :active="request()->routeIs('job.list')">
                                    {{ __('Job Lists') }}
                                </x-nav-link>
                            </div>
                        </div>

                    @if(auth()->check())

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">


                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">

                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <!-- Smaller Avatar Image -->
                                <img class="w-8 h-8 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500 mr-1" src="/avatars/{{Auth::user()->avatar}}" alt="Bordered avatar">


                            <div>{{ Auth::user()->username }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="Auth::check() ? (Auth::user()->type == 'student' ? route('student.dashboard') : route('employer.dashboard')) : null" :active="request()->routeIs('dashboard')">
                                    {{ __('Dashboard') }}
                            </x-dropdown-link>

                            @if ( Auth::user()->type === 'student')

                                <x-dropdown-link :href="route('student.profile.detail')">
                                    {{__('View Profile')}}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('student.dashboard')">
                                    {{ __('Edit Profile') }}
                                </x-dropdown-link>
                            @else
                                <x-dropdown-link :href="route('empProfile.detail')">
                                    {{ __('View Profile') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('empProfile.edit', $id=Auth::user()->id)">
                                    {{ __('Edit Profile') }}
                                </x-dropdown-link>
                            @endif

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>

                            </form>
                        </x-slot>
                    </x-dropdown>
                    </div>

                    @else
                        <!-- Right menu -->
                        <div class="hidden sm:flex sm:items-center sm:ml-6">

                            <!-- Login -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <x-nav-link :href="route('login')">
                                    {{ __('Log in') }}
                                </x-nav-link>
                            </div>


                            <!-- Settings Dropdown -->
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                        <div>{{ __('Register') }}</div>

                                        <div class="ml-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <!-- Student-->
                                    <x-dropdown-link :href="route('student.register.view')">
                                        {{ __('Student') }}
                                    </x-dropdown-link>

                                    <!-- Employer -->
                                        <x-dropdown-link :href="route('empRegister.view')">
                                            {{ __('Employer') }}
                                        </x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @endif


                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        @auth
                        <x-responsive-nav-link :href="Auth::user()->type === 'student' ? route('student.dashboard') : route('employer.dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-responsive-nav-link>
                        @endauth
                        <x-responsive-nav-link :href="route('job.list')" :active="request()->routeIs('job.list')">
                            {{ __('Job Lists') }}
                        </x-responsive-nav-link>


                    </div>

                    @if(!auth()->check())
                    <!-- Responsive Settings Options -->
                        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                            <div class="px-4">
                                <div class="font-medium text-base text-gray-800 dark:text-gray-200">
                                    <x-responsive-nav-link :href="route('login')">
                                        {{ __('Log in') }}
                                    </x-responsive-nav-link>
                                </div>
                                <br>
                            </div>

                            <div class="px-4">
                                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ __('Register') }}</div>
                                <div class="font-medium text-sm text-gray-500">{{ __('Register as a Student or Employer') }}</div>
                            </div>

                            <div class="mt-3 space-y-1">
                                <!-- Student-->
                                <x-responsive-nav-link :href="route('student.register.view')">
                                    {{ __('Student') }}
                                </x-responsive-nav-link>

                                <x-responsive-nav-link :href="route('empRegister.view')">
                                    {{ __('Employer') }}
                                </x-responsive-nav-link>
                            </div>
                        </div>
                    @endif

                    @auth
                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->username }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            @if ( Auth::user()->type === 'student')
                                <x-dropdown-link :href="route('student.profile.detail')">
                                    {{ __('View Profile') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('student.profile.edit')">
                                    {{ __('Edit Profile') }}
                                </x-dropdown-link>
                            @else
                                <x-dropdown-link :href="route('empProfile.detail')">
                                    {{ __('View Profile') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('empProfile.edit', $id=Auth::user()->id)">
                                    {{ __('Edit Profile') }}
                                </x-dropdown-link>
                            @endif

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-responsive-nav-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-responsive-nav-link>
                            </form>
                        </div>
                    </div>

                    @endauth




                </div>
            </nav>

            <!-- Hero Section  -->
            @if(auth()->check())
                @if (Auth::user()->type== 'student')
                <header class="bg-white dark:bg-gray-900">
                    <div class="w-full bg-center bg-cover h-screen" style="background-image: url('{{ asset('images/aiu-road.jpg') }}');  height: 91vh; overflow: hidden;">
                        <div class="flex items-center justify-center w-full h-full bg-gray-900/40">
                            <div class="text-center">
                                <h1 class="text-3xl font-semibold text-white lg:text-4xl">"Craft your <span class="text-blue-400">Career</span> with purpose and passion"</h1>
                                <br>
                                <p class="text-3xl font-thin text-white font-mono">Welcome</p>
                            </div>
                        </div>
                    </div>
                </header>

                @else
                <header class="bg-white dark:bg-gray-900">
                    <div class="w-full bg-center bg-cover h-screen" style="background-image: url('{{ asset('images/aiu-road.jpg') }}');  height: 91vh; overflow: hidden;">
                        <div class="flex items-center justify-center w-full h-full bg-gray-900/40">
                            <div class="text-center">
                                <h1 class="text-3xl font-semibold text-white lg:text-4xl">"Find <span class="text-blue-400">Talent</span>, Build Success"</h1>
                                <br>
                                <p class="text-3xl font-thin text-white font-mono">Welcome</p>
                            </div>
                        </div>
                    </div>
                </header>


                @endif
            @else
            <header class="bg-white dark:bg-gray-900">
                <div class="w-full bg-center bg-cover h-screen" style="background-image: url('{{ asset('images/aiu-road.jpg') }}');  height: 91vh; overflow: hidden;">
                    <div class="flex items-center justify-center w-full h-full bg-gray-900/40">
                        <div class="text-center">
                            <h1 class="text-3xl font-semibold text-white lg:text-4xl">Discover your exciting <span class="text-blue-200 border border-white border-4">Career</span> journey ahead</h1>
                            <a href="{{ route('job.list') }}">
                                <br>
                            <button class="w-full px-5 py-2 mt-4 text-sm font-medium text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-md lg:w-auto hover:bg-blue-500 focus:outline-none focus:bg-blue-500">Search career</button>
                            </a>
                        </div>
                    </div>
                </div>
            </header>
        </div>
        @endif

        @include('layouts.footer')



          <!-- Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/datepicker.min.js"></script>
    </body>
</html>
