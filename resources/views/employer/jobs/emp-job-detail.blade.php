<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Jobs Detail') }}
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto mb-8 mt-2 p-6 bg-white rounded-lg shadow-lg ">
        <div class="py-10">
            <h1 class="text-4xl text-gray-800 font-base text-center mb-2 font-montserrat">{{ $job->title }}</h1>
            <p class="pb-2 pt-4 text-gray-500 text-center"> <span class="font-semibold">at</span> <span class="uppercase text-blue-400 font-bold">{{ $job->company }}</span> <span class="font-semibold">as </span><span class="bg-yellow-400 font-bold text-xs text-white rounded px-3">{{ $job->job_type }}</span></p>
        </div>
        
        <hr class="my-4">

        <div class="grid grid-cols-4 gap-4 mb-4 mx-auto w-full max-w-screen-lg">
            <div>
                <h2 class="text-l font-base mb-2 font-montserrat">Location:  </h2>
                <p class="text-gray-400 text-sm font-montserrat">{{ $job->city }}, {{ $job->country }}</p>
            </div>

            <div >
                <h2 class="text-l font-base mb-2 font-montserrat">Category</h2>
                <p class="text-gray-400 text-sm font-montserrat">{{ $job->category }}</p>
            </div>

            <div>
                <h2 class="text-l font-base mb-2 font-montserrat">Experience</h2>
                <p class="text-gray-400 text-sm font-montserrat">Null</p>
            </div>

            <div>
                <h2 class="text-l font-base mb-2 font-montserrat">Posted Date:  </h2>
                <p class="text-gray-400 text-sm font-montserrat">{{ $job->created_at->diffForHumans() }}</p>
            </div>
        </div>

        <hr class="my-4">

        <div class="mb-4">
            <h2 class="text-xl font-base mb-2 font-montserrat">Company Overview</h2>
            <div class="my-6 mb-4">
                <div class="flex items-start mb-4">
                    @if ($userAvatar)
                        <img src="/avatars/{{$userAvatar->avatar}}" alt="Company Logo" style="width: 200px; height: auto;" class="h-12 mr-4">
                    @endif
                    <p class="text-gray-600 flex items-start">{{ $company->about }}</p>
                </div>
            </div>

        </div>

        <div class="my-6 py-2">
            <h2 class="text-xl font-base my-4 font-montserrat"><span>Description</span></h2>
            <p class="text-gray-700 border-t pt-4">{{ $job->description }}</p>
        </div>
       

        <div class="mb-6">
            <h2 class="text-xl font-base my-4 font-montserrat"><span>Requirements: </span></h2>
            <p class="text-gray-700 border-t pt-4">{{ $job->requirement }}</p>
        </div>

        <div class="mb-6">
            <h2 class="text-xl font-base my-4 font-montserrat">
                <span>How to Apply</span>
            </h2>
            <p class="text-gray-700 border-t pt-4">{{ $job->how_to }}</p>
        </div>
        
    </div>


</x-app-layout>