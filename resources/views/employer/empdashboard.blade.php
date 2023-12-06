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
                            @foreach($students as $data)    
                                <div class="overflow-y-hidden rounded-lg border">
                                    <div class="overflow-x-auto">
                                        <table class="w-full">
                                            <thead>
                                                <tr
                                                    class="bg-blue-600 text-left text-xs font-semibold uppercase tracking-widest text-white">
                                                    <th class="px-5 py-3">ID</th>
                                                    <th class="px-5 py-3">Full Name</th>
                                                    <th class="px-5 py-3">Email</th>
                                                    <th class="px-5 py-3">Created at</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-gray-500">
                                                <tr>
                                                    <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                                        <p class="whitespace-no-wrap">3</p>
                                                    </td>
                                                    <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                                        <div class="flex items-center">
                                                            <div class="h-10 w-10 flex-shrink-0">
                                                                <img class="h-full w-full rounded-full"
                                                                    src="/avatars/{{$data->user->avatar}}" alt="student_profile_pic" />
                                                            </div>
                                                            <div class="ml-3">
                                                                <p class="whitespace-no-wrap">{{$data->username }}</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                                        <p class="whitespace-no-wrap"> {{ $data->email }}</p>
                                                    </td>
                                                    <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                                        <p class="whitespace-no-wrap">{{ $data->created_at }}</p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>




       
</x-app-layout>
