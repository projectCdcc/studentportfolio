<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Jobs Detail') }}
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto mb-8 mt-2 p-6 bg-white rounded-lg shadow-lg">
        <div class="py-10">
            <h1 class="text-4xl font-light text-center mb-2">{{ $job->title }}</h1>
            <p class="pb-2 pt-4 text-gray-500 text-center">at <span class="uppercase text-blue-400 font-bold">{{ $job->company }}</span> as <span class="bg-yellow-400 text-xs text-white rounded px-2">{{ $job->job_type }}</span></p>
        </div>
        
        <hr class="my-4">

        <div class="grid grid-cols-3 gap-4 mb-4 mx-auto w-full max-w-screen-lg">
            <div class="text-centre">
                <h2 class="text-l font-base mb-2">Location: </h2>
                <p class="text-gray-600">{{ $job->city }}, {{ $job->country }}</p>
            </div>

            <div>
                <h2 class="text-l font-base mb-2">Category</h2>
                <p class="text-gray-600">{{ $job->category }}</p>
            </div>

            <div>
                <h2 class="text-l font-base mb-2">Posted Date: </h2>
                <p class="text-gray-600">{{ $job->created_at->diffForHumans() }}</p>
            </div>
        </div>


        <hr class="my-4">

        <div class="mb-4">
            <h2 class="text-xl font-base mb-2">Company Overview</h2>
            <div class="my-6 mb-4">
                <div class="flex items-start mb-4">
                    <img src="/avatars/{{Auth::user()->avatar }}" alt="Company Logo" style="width: 200px; height: auto;" class="h-12 mr-4">
                      <p class="text-gray-600 flex items-start">{{ $company->about }}</p>
                </div>
            </div>

        </div>

        <div class="my-6 py-2">
            <h2 class="text-xl font-base mb-4"><span class="bg-purple-800 text-white p-2 rounded">Description</span></h2>
            <p class="text-gray-700 border-t pt-4">{{ $job->description }}</p>
        </div>
       

        <div class="mb-6">
            <h2 class="text-xl font-base mb-4"><span class="bg-purple-800 text-white p-2 rounded">Requirements</span></h2>
            <p class="text-gray-700 border-t pt-4">{{ $job->requirement }}</p>
        </div>

        <div class="mb-6 ">
            <h2 class="text-xl font-base mb-4">
                <span class="bg-purple-800 text-white p-2 rounded">How to Apply</span>
            </h2>
            <p class="text-gray-700 border-t pt-4">{{ $job->how_to }}</p>
        </div>
        
    </div>


</x-app-layout>