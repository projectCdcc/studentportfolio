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

                <!-- Registered user -->
                <div class="lg:w-2/3">
                    <div class="card mb-4">
                        <div class="container">
                            <div class="mx-auto max-w-screen-lg px-2 sm:px-8">
                                <div class="flex items-center justify-between pb-6">
                                    <div>
                                        <h2 class="text-2xl font-semibold text-gray-700">Students</h2>
                                        <span class="text-sm text-gray-500">Browse Registered Student Profiles</span>
                                    </div>

                                    <!-- Search -->
                                    <div class="flex items-center justify-between">

                                    </div>


                                </div>
                                @if(count($students) > 0)
                                <div class="overflow-y-hidden rounded-lg border">
                                    <div class="overflow-x-auto">
                                        <div class="my-2">
                                            <input type="text" class="form-input mt-1 block w-full" id="search" name="search" placeholder="Search students...">
                                        </div>

                                        <table class="w-full">
                                            <thead>
                                                <tr
                                                    class="bg-purple-900 text-left text-xs font-semibold uppercase tracking-widest text-white">
                                                    <th class="px-5 py-3">ID</th>
                                                    <th class="px-5 py-3">Full Name</th>
                                                    <th class="px-5 py-3">Email</th>
                                                    <th class="px-5 py-3">Major / Field of Study</th>
                                                </tr>
                                            </thead>

                                            <tbody id="initialStudentList" class="text-gray-500">
                                                @foreach($students as $data)
                                                 <tr>
                                                    <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                                                        <p class="whitespace-no-wrap">{{$data->id }}</p>
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
                                                        <p class="whitespace-no-wrap">{{ $data->major }}</p>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>



                                            <!-- AJAX search results -->
                                            <tbody id="ajaxStudentList" style="display: none;"></tbody>
                                        </table>
                                    </div>
                                    <div id="paginationLinks">
                                        {{ $students->links() }}
                                    </div>

                                </div>


                                <!-- Add a loading indicator with moving dots animation and larger font (hidden by default) -->
                                <div id="loadingIndicator" class="my-4" style="display: none; font-size: 20px; text-align: center;">
                                    <div class="loader">
                                        <div class="dot"></div>
                                        <div class="dot"></div>
                                        <div class="dot"></div>
                                    </div>
                                    Loading...
                                </div>

                                <style>
                                    .loader {
                                        display: flex;
                                        justify-content: center;
                                    }

                                    .loader .dot {
                                        height: 10px;
                                        width: 10px;
                                        margin: 0 5px;
                                        background-color: #3498db;
                                        border-radius: 50%;
                                        opacity: 0.5;
                                        animation: blink 1.4s infinite both;
                                    }

                                    .loader .dot:nth-child(2) {
                                        animation-delay: 0.2s;
                                    }

                                    .loader .dot:nth-child(3) {
                                        animation-delay: 0.4s;
                                    }

                                    @keyframes blink {
                                        0%, 80%, 100% { transform: scale(0); opacity: 0.5; }
                                        30%, 50% { transform: scale(1); opacity: 1; }
                                    }
                                </style>
                                <!-- Loading animation End here -->


                                <script type="text/javascript">
                                    $(document).ready(function() {
                                        let debounceTimer;
                                        $('#search').on('keyup', function() {
                                            clearTimeout(debounceTimer);
                                            let value = $(this).val().trim(); // Trim whitespace

                                            // Toggle visibility of student lists based on search input
                                            let isSearching = value !== '';
                                            $('#initialStudentList').toggle(!isSearching);
                                            $('#ajaxStudentList').toggle(isSearching);
                                            $('#loadingIndicator').toggle(isSearching);

                                            // Assuming '#paginationLinks' is the ID of the element containing the pagination links
                                             $('#paginationLinks').toggle(!isSearching);

                                            if (isSearching) {
                                                debounceTimer = setTimeout(() => {
                                                    $.ajax({
                                                        type: 'get',
                                                        url: '{{ URL::to("search") }}',
                                                        data: { 'search': value },
                                                        success: function(data) {
                                                            if (data.trim().length === 0) {
                                                                // If no data is returned, show a 'no records found' message
                                                                $('#ajaxStudentList').html('<p class="my-2">No records found</p>');
                                                                $('#paginationLinks').hide();
                                                            } else {
                                                                // If data is returned, populate the list with it
                                                                $('#ajaxStudentList').html(data);
                                                            }
                                                        },
                                                        complete: function() {
                                                            $('#loadingIndicator').hide();
                                                        }
                                                    });
                                                }, 500); // Delay for 500 ms
                                            }
                                        });
                                    });
                                </script>





                                <script type="text/javascript">
                                    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
                                </script>

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
