<div class="mt-2">
    <div
        class="pt-4 w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-col items-center pb-10">

            <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="/avatars/{{Auth::user()->avatar}}" alt="Profile Image" />

            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ Auth::user()->username }}</h5>
            <span class="text-sm text-gray-500 dark:text-gray-400">{{ Auth::user()->type }}</span>
            <div class="flex mt-4 md:mt-6">
                <a href="{{ route('empProfile.detail') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-center bg-purple-900 text-white rounded-lg hover:bg-purple-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('View Profile') }}</a>
            </div>
        </div>
    </div>



    <div class="pt-3">
    <div aria-label="navigation" class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <nav class="grid gap-1">
            <a href="{{ route('empJob.show', $id=Auth::user()->id)}}"
                class="flex items-center leading-6 space-x-3 py-3 px-4 w-full text-lg text-gray-600 focus:outline-none hover:bg-gray-300 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" aria-hidden="true" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M1 10c1.5 1.5 5.25 3 9 3s7.5-1.5 9-3m-9-1h.01M2 19h16a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1ZM14 5V3a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v2h8Z"/>
                </svg>

                <span >{{ __('Posted Jobs') }}</span>
            </a>
        </nav>
    </div>
    </div>


    <div class="pt-3">
    <div aria-label="navigation" class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <nav class="grid gap-1">
            <a href="{{ route('empProfile.edit', $id=Auth::user()->id)}}"
                class="flex items-center leading-6 space-x-3 py-3 px-4 w-full text-lg text-gray-600 focus:outline-none hover:bg-gray-300 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                </svg>
                <span >{{ __('Edit Profile') }}</span>
            </a>
        </nav>
    </div>
    </div>

    <div class="pt-3">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <div aria-label="footer" class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a href="{{ route('logout')}}" onclick="event.preventDefault();
                            this.closest('form').submit();">
            <button type="button" class="flex items-center space-x-3 py-3 px-4 w-full leading-6 text-lg text-gray-600 focus:outline-none hover:bg-gray-300 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-7 h-7" width="24" height="24"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2"></path>
                    <path d="M9 12h12l-3 -3"></path>
                    <path d="M18 15l3 -3"></path>
                </svg>
                <span href="{{route('logout')}}">{{ __('Log Out') }}</span>
            </button>
            </a>
        </div>
    </form>
    </div>
</div>
