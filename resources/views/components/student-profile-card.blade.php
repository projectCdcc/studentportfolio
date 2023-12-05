<div
        class="pt-4 w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-col items-center pb-10">

            <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="/avatars/{{Auth::user()->avatar}}" alt="Profile Image" />

            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ Auth::user()->username }}</h5>
            <span class="text-sm text-gray-500 dark:text-gray-400">{{ Auth::user()->type }}</span>
            <div class="flex mt-4 md:mt-6">
                <a href="{{ route('student.profile.detail') }}"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-center bg-purple-900 text-white rounded-lg hover:bg-purple-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">{{ __('View Profile') }}</a>
            </div>
        </div>
    </div>



    <div class="pt-2">
        <div aria-label="navigation" class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <nav class="grid gap-1">
                <a href="{{ route('empJob.show', $id=Auth::user()->id)}}"
                    class="flex items-center leading-6 space-x-3 py-3 px-4 w-full text-base text-gray-600 focus:outline-none hover:bg-gray-300 rounded-md">
                    <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                        <path d="M3 24h19v-23h-1v22h-18v1zm17-24h-18v22h18v-22zm-1 1h-16v20h16v-20zm-2 16h-12v1h12v-1zm0-3h-12v1h12v-1zm0-3h-12v1h12v-1zm-7.348-3.863l.948.3c-.145.529-.387.922-.725 1.178-.338.257-.767.385-1.287.385-.643 0-1.171-.22-1.585-.659-.414-.439-.621-1.04-.621-1.802 0-.806.208-1.432.624-1.878.416-.446.963-.669 1.642-.669.592 0 1.073.175 1.443.525.221.207.386.505.496.892l-.968.231c-.057-.251-.177-.449-.358-.594-.182-.146-.403-.218-.663-.218-.359 0-.65.129-.874.386-.223.258-.335.675-.335 1.252 0 .613.11 1.049.331 1.308.22.26.506.39.858.39.26 0 .484-.082.671-.248.187-.165.322-.425.403-.779zm3.023 1.78l-1.731-4.842h1.06l1.226 3.584 1.186-3.584h1.037l-1.734 4.842h-1.044z"/>
                    </svg>
                    <span >{{ __('Uploaded CV') }}</span>
                </a>
            </nav>
        </div>
    </div>


    <div class="pt-2">
    <div aria-label="navigation" class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <nav class="grid gap-1">
            <a href="{{ route('student.profile.edit')}}"
                class="flex items-center leading-6 space-x-3 py-3 px-4 w-full text-base text-gray-600 focus:outline-none hover:bg-gray-300 rounded-md">
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

    <div class="pt-2 pb-2">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <div aria-label="footer" class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a href="{{ route('logout')}}" onclick="event.preventDefault();
                            this.closest('form').submit();">
            <button type="button" class="flex items-center space-x-3 py-3 px-4 w-full leading-6 text-base text-gray-600 focus:outline-none hover:bg-gray-300 rounded-md">
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

