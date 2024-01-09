<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>


    <div class="pt-6 pb-12">
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
                                <div class="my-2">
                                    <input type="text" class="form-input mt-1 block w-full" id="search" name="search" placeholder="Search jobs...">
                                </div>
                                <div id="initialJobList">
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
                                </div>

                                <div id="ajaxJobList" style="display: none;"></div>
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
                            </div>
                        </div>
                        <div id="paginationLinks">
                            {{ $jobs->links() }}
                        </div>
                    </div>

                    <script type="text/javascript">
                        $(document).ready(function() {
                            let debounceTimer;
                            $('#search').on('keyup', function() {
                                clearTimeout(debounceTimer);
                                let value = $(this).val().trim(); // Trim whitespace

                                // Toggle visibility of job lists based on search input
                                let isSearching = value !== '';
                                $('#initialJobList').toggle(!isSearching);
                                $('#ajaxJobList').toggle(isSearching);
                                $('#loadingIndicator').toggle(isSearching);
                                // Assuming '#paginationLinks' is the ID of the element containing the pagination links
                                $('#paginationLinks').toggle(!isSearching);


                                if (isSearching) {
                                    debounceTimer = setTimeout(() => {
                                        $.ajax({
                                            type: 'get',
                                            url: '{{ URL::to("find") }}',
                                            data: { 'find': value },
                                            success: function(data) {
                                                if (data.trim().length > 0) {
                                                    // If data is returned, display it
                                                    $('#ajaxJobList').html(data);
                                                } else {
                                                    // If no data is returned, display a no result found message
                                                    $('#ajaxJobList').html('<p class="my-2">No results found.</p>');
                                                    $('#paginationLinks').hide();
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
