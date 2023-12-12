<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="pb-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
            <div class="lg:flex lg:space-x-6">
                <!-- Employer Profile Card -->
                <div class="lg:w-1/3">
                    <x-employer-profile-card>

                    </x-employer-profile-card>
                </div>
                @if(count($students) > 0)
                <!-- Registered user -->
                <div class="lg:w-2/3">
                    <div class="card mb-4">
                        <div class="container">
                            <div class="mx-auto max-w-screen-lg px-2 sm:px-8">
                                <div class="flex items-center justify-between pb-6">
                                    <div>
                                        <h2 class="font-semibold text-gray-700">Students</h2>
                                        <span class="text-xs text-gray-500">View accounts of registered students</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                    </div>
                                </div>
                            
                                <div class="overflow-y-hidden rounded-lg border">
                                    <div class="overflow-x-auto">
                                        <table class="w-full">
                                            <thead>
                                                <tr
                                                    class="bg-purple-900 text-left text-xs font-semibold uppercase tracking-widest text-white">
                                                    <th class="px-5 py-3">ID</th>
                                                    <th class="px-5 py-3">Full Name</th>
                                                    <th class="px-5 py-3">Email</th>
                                                    <th class="px-5 py-3">Created at</th>
                                                </tr>
                                            </thead>
                                            @foreach($students as $data)   
                                            <tbody class="text-gray-500">
                                                <tr>
                                                    <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                                        <p class="whitespace-no-wrap">{{$data->user_id }}</p>
                                                    </td>
                                                    <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                                        <div class="flex items-center">
                                                            <div class="ml-3">
                                                            <a href="{{ route('employer.view.student', [$id=$data->id]) }}" class="text-blue-800 hover:underline">{{ $data->username}}</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                                        <p class="whitespace-no-wrap"> {{ $data->email }}</p>
                                                    </td>
                                                    <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                                        <p class="whitespace-no-wrap">{{ date('Y-m-d', strtotime($data->created_at)) }}</p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                @else 

                <span class="text-lg text-gray-500">No Students have been registered!</span>
                
                @endif

            </div>
        </div>
    </div>
       
</x-app-layout>
