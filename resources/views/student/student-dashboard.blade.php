<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="pb-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
            <div class="lg:flex lg:space-x-6">
                <!-- Student Profile Card -->
                <div class="lg:w-1/3">
                    <x-student-profile-card>
                    </x-student-profile-card>
                </div>

            @if(count($jobs) > 0)

                    <!-- Jobs Opening -->
                    <div class="lg:w-2/3">
                        <div class="card mb-4">
                            <div class="container">
                                <div class="text-center my-5">
                                    <h3 class="text-2xl">Jobs Opening</h3>
                                    <p class="lead">Lists of jobs that are posted on our platform</p>
                                </div>
                                @foreach($jobs as $data)
                                    <div class="bg-white my-4 shadow-xl shadow-gray-100 w-full max-w-4xl flex flex-col sm:flex-row gap-3 sm:items-center  justify-between px-5 py-4 rounded-md">
                                        <div>
                                            <span class="text-purple-800 text-sm">{{ $data->category }}</span>
                                            <h3 class="font-bold mt-px">{{ $data->title }}</h3>
                                            <div class="flex items-center gap-3 mt-2">
                                                <span class="bg-purple-100 text-purple-700 rounded-full px-3 py-1 text-sm">
                                                    {{ $data->job_type }}</span>
                                                <span class="text-slate-600 text-sm flex gap-1 items-center"> <svg xmlns="http://www.w3.org/2000/svg"
                                                        class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    </svg>{{ $data->city }} , {{ $data->country }}</span>
                                            </div>
                                        </div>
                                        <div>
                                        <a href="{{ route('employer.job.detail', [$id=$data->id]) }}">
                                            <button class="bg-purple-900 text-white font-medium px-4 py-2 rounded-md flex gap-1 items-center">View
                                                Detail <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                                </svg>
                                                </svg>
                                            </button>
                                        </a>
                                        </div>
                                    </div>
                                @endforeach
                                {{ $jobs->links() }}
                                </div>
                        </div>
                    </div>
            @else
            <!-- Jobs Opening -->
            <div class="lg:w-2/3">
                <div class="card mb-4">
                    <div class="container">
                        <div class="text-center my-5">
                            <h3 class="text-2xl">Jobs Opening</h3>
                            <p class="lead">Lists of jobs that are posted on our platform</p>
                        </div>
                        <h1>No records found!</h1>
                    </div>
                </div>
            </div>
            @endif

            </div>
        </div>
    </div>

</x-app-layout>
