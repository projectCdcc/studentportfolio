<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile Details') }}
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto mb-8 mt-2 p-6 bg-white rounded-lg shadow-lg ">
        <div class="pt-10 pb-3 flex flex-col items-center justify-center">
            <img src="/avatars/{{Auth::user()->avatar }}" alt="Company Logo" style="width: 200px; height: auto;" class="h-12 mr-4">
            <h1 class="text-4xl text-gray-800 font-base text-center mt-6 mb-2 font-montserrat">{{ $employer->organization_name }}</h1>
            <p class="pb-2 pt-4 text-gray-500 text-center"> <span class="text-slate-600 text-sm flex gap-1 items-center"> <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg> {{ $employer->street}} {{ $employer->city }}, {{ $employer->country }}</span>
            </p>
        </div>
        
        <hr class="my-4">

        <div class="grid grid-cols-3 gap-4 mb-4 mx-auto w-full max-w-screen-lg ">
            
            <div class="text-centre">
                <h2 class="text-l font-base mb-2 font-montserrat">Established in: </h2>
                <p class="text-gray-400 text-sm font-montserrat">{{ $employer->establish_year}}</p>
            </div>

            <div>
                <h2 class="text-l font-base mb-2 font-montserrat">Type</h2>
                <p class="text-gray-400 text-sm font-montserrat">{{ $employer->org_type }}</p>
            </div>

            <div>
                <h2 class="text-l font-base mb-2 font-montserrat">Website </h2>
                <p class="text-gray-400 text-sm font-montserrat">{{-- $job->created_at->diffForHumans() --}}</p>
            </div>
        </div>


        <hr class="my-4">

        <div class="mb-4">
            <h2 class="text-xl font-base mb-2 font-montserrat">Company Overview</h2>
            <div class="my-6 mb-4">
                <div class="flex items-start mb-4">
                      <p class="text-gray-600 flex items-start">{{ $employer->about }}</p>
                </div>
            </div>

        </div>

        <div class="my-6 py-2">
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
        </div>
        
    </div>

    
</x-app-layout>
