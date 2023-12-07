<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile Details') }}
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto mb-8 mt-2 p-6 bg-white rounded-lg shadow-lg ">
        <div class="pt-10 pb-3 flex flex-col items-center justify-center">
            <img src="/avatars/{{$user->avatar }}" alt="User-profile-pic" style="width: 200px; height: auto;" class="h-12 mr-4">
            <h1 class="text-4xl text-gray-800 font-base text-center mt-6 mb-2 font-montserrat">{{ $student->username }}</h1>

        </div>

        <hr class="my-4">

        <div class="grid grid-cols-3 gap-4 mb-4 mx-auto w-full max-w-screen-lg ">

            <div class="text-centre">
                <h2 class="text-l font-base mb-2 font-montserrat">Email: </h2>
                <p class="text-gray-400 text-sm font-montserrat">{{ $student->email}}</p>
            </div>

            <div>
                <h2 class="text-l font-base mb-2 font-montserrat">Graduate Date:</h2>
                <p class="text-gray-400 text-sm font-montserrat">{{ date('Y-m-d', strtotime($student->graduate_date)) }}</p>
            </div>

            <div>
                <h2 class="text-l font-base mb-2 font-montserrat">Profession:</h2>
                <p class="text-gray-400 text-sm font-montserrat">{{ __('Null') }}</p>
            </div>


        </div>


        <hr class="my-4">

        <div class="mb-4">
            <h2 class="text-xl font-base mb-2 font-montserrat">About me</h2>
            <div class="my-6 mb-4">
                <div class="flex items-start mb-4">
                      <p class="text-gray-600 flex items-start">{{ $student->about_me }}</p>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <h2 class="text-xl font-base mb-2 font-montserrat">My CV</h2>
            <div class="my-6 mb-4">
                <div class="flex items-start mb-4">
                    <div style="width: 100%; overflow-x: auto;">
                        <embed src="/cv/{{$cv->attachment}}" style="width: 100%; height: 1100px;" type="application/pdf">
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="my-6 py-2">
            <h2 class="text-xl font-base my-4 font-montserrat"><span>Description</span></h2>
            <p class="text-gray-700 border-t pt-4">{{-- $job->description --}}</p>
        </div>


        <div class="mb-6">
            <h2 class="text-xl font-base my-4 font-montserrat"><span>Requirements: </span></h2>
            <p class="text-gray-700 border-t pt-4">{{-- $job->requirement --}}</p>
        </div>

        <div class="mb-6">
            <h2 class="text-xl font-base my-4 font-montserrat">
                <span>How to Apply</span>
            </h2>
            <p class="text-gray-700 border-t pt-4">{{-- $job->how_to --}}</p>
        </div> -->

    </div>


</x-app-layout>
