<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Jobs List') }}
        </h2>
    </x-slot>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="font-medium text-2xl bg-purple py-2 text-purple-900 uppercase">Opening Jobs</h1>
            <div class="pb-8 pt-2">
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
                                {{-- @php
                                dd($jobs);
                                @endphp --}}
                                @foreach($jobs as $job)

                                <tbody>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-wrap dark:text-white border-l border-t w-1/5 overflow-hidden">
                                            <a href="{{ route('employer.job.detail', [$id=$job->id]) }}" class="text-blue-800 hover:underline">{{ $job->title}}</a>
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
                            {{ $jobs->links() }}
                        </div>
                    @else
                <h3>No Records found .....</h3>
                @endif
            </div>

        </div>

</x-app-layout>
