<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Jobs List') }}
        </h2>
    </x-slot>


    <div class="py-4">


        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="font-medium text-2xl bg-purple p-4 text-purple-900 uppercase">Opening Jobs</h1>


            <div class="py-4">
                @if(count($jobs) > 0)
                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-700 dark:text-gray-400 border table-fixed">
                                <thead
                                    class="text-xs text-white uppercase bg-purple-900 dark:bg-gray-700 dark:text-gray-400 uppercase ">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 border-l border-t w-1/5">
                                            Title

                                        </th>
                                        <th scope="col" class="px-6 py-3 border-l border-t w-1/5">
                                            Company
                                        </th>
                                        <th scope="col" class="px-6 py-3 border-l border-t w-1/5">
                                            Location
                                        </th>
                                        <th scope="col" class="px-6 py-3 border-l border-t w-3/5">
                                            Description
                                        </th>
                                        <th scope="col" class="px-6 py-3 border-l border-t w-1/5">
                                            Posted Date
                                        </th>
                                    </tr>
                                </thead>

                                @foreach($jobs as $job)

                                <tbody>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-wrap dark:text-white border-l border-t w-1/5 overflow-hidden">
                                            {{ $job->title}}
                                        </th>
                                        <td class="px-6 py-4 border-l border-t w-1/5 uppercase">
                                            {{ $job->company}}
                                        </td>
                                        <td class="px-6 py-4 border-l border-t w-1/5">
                                            {{ $job->city}}, {{ $job->country}}
                                        </td>
                                        <td class="px-6 py-4 border-l border-t w-3/5">
                                            {{ substr($job->description, 0, 100)}} ....
                                        </td>

                                        <td class="px-6 py-4 border-l border-t w-1/5">
                                            {{ date('Y-m-d', strtotime($job->created_at));}}
                                        </td>
                                    </tr>
                                </tbody>
                                @endforeach
                            </table>
                        </div>



                        {{-- <div
                                class="bg-gray-100 shadow-xl shadow-gray-500 w-full max-w-6xl flex flex-col sm:flex-row gap-4 sm:items-center  justify-between px-5 py-4 rounded-md">
                                <div>
                                    <span class="text-purple-800 text-sm">{{ $job->category }}</span>
                        <h3 class="font-bold mt-px">{{ $job->title }}</h3>
                        <div class="flex items-center gap-3 mt-2">
                            <span
                                class="bg-purple-100 text-purple-700 rounded-full px-3 py-1 text-sm">{{ $job->job_type }}</span>
                            <span class="text-slate-600 text-sm flex gap-1 items-center"> <svg
                                    xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg> {{ $job->city }}, {{ $job->country }}</span>

                            <span class="text-purple-800 text-sm uppercase">{{ $job->company }}</span>
                        </div>
            </div>
            <div>
                <button class="bg-purple-900 text-white font-medium px-4 py-2 rounded-md flex gap-1 items-center">View
                    Details
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </button>
            </div>
        </div> --}}


    @else

        <h3>No Records found .....</h3>


        @endif

    </div>
    </div>
    </div>

</x-app-layout>
