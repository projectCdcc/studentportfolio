<x-app-layout>
    @section('title','Post Job')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Posted Jobs') }}
        </h2>
    </x-slot>


    <div class="py-4">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Start block -->
            <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5 antialiased ">
                <div class="mx-auto max-w-screen-xl px-4 lg:px-12">
                    <!-- Start coding here -->

                    <h1 class="py-4">Jobs History</h1>
                    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                        <div
                            class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                            <div class="w-full md:w-1/2">

                            </div>
                            <div
                                class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                                <button type="button" id="createProductModalButton" data-modal-target="createJobModal"
                                    data-modal-toggle="createJobModal"
                                    class="flex items-center justify-center inline-flex items-center px-4 py-2 text-sm font-medium text-center bg-purple-900 text-white rounded-lg hover:bg-purple-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path clip-rule="evenodd" fill-rule="evenodd"
                                            d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                    </svg>
                                    Add Job
                                </button>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-t border-gray-300">
                                    <tr class="border-b border-gray-300">
                                        <th scope="col" class="px-4 py-4">Title</th>
                                        <th scope="col" class="px-4 py-3">Company</th>
                                        <th scope="col" class="px-4 py-3">Location</th>
                                        <th scope="col" class="px-4 py-3">Description</th>
                                        <th scope="col" class="px-4 py-3">Posted Date</th>
                                        <th scope="col" class="px-4 py-3">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @isset($jobs)
                                        @foreach($jobs as $job)
                                            <tr class="border-b dark:border-gray-700">
                                                <th scope="row"
                                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{ $job->title }}</th>
                                                <td class="px-4 py-3">{{ $job->company }}</td>
                                                <td class="px-4 py-3">{{ $job->city }}, {{ $job->country }}</td>
                                                <td class="px-4 py-3 max-w-[12rem] truncate">
                                                    {{ substr($job->description, 0,  40) }}</td>
                                                <td class="px-4 py-3">{{ $job->created_at }}</td>
                                                <td
                                                    class="py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                                                    <div id="jobShow" class="flex items-center">

                                                        <button type="button" data-modal-target="updateJobModal"
                                                            data-modal-toggle="updateJobModal"
                                                            data-jobid="{{ $job->id }}"
                                                            data-title="{{ $job->title }}"
                                                            data-city="{{ $job->city }}"
                                                            data-country="{{ $job->country }}"
                                                            data-company="{{ $job->company }}"
                                                            data-description="{{ $job->description }}"
                                                            data-category="{{ $job->category }}"
                                                            data-job-type="{{ $job->job_type }}"
                                                            data-requirement="{{ $job->requirement }}"
                                                            data-how-to="{{ $job->how_to }}"
                                                            class="flex w-full items-center py-2 px-4 hover:bg-gray-400 dark:hover:bg-gray-600 rounded-lg dark:hover:text-white text-gray-700 dark:text-gray-200">
                                                            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg"
                                                                viewbox="0 0 20 20" fill="currentColor"
                                                                aria-hidden="true">
                                                                <path
                                                                    d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" />
                                                            </svg>
                                                            Edit
                                                        </button>


                                                        <button type="button" data-modal-target="readJobModal"
                                                            data-modal-toggle="readJobModal"
                                                            data-jobid="{{ $job->id }}"
                                                            data-title="{{ $job->title }}"
                                                            data-city="{{ $job->city }}"
                                                            data-country="{{ $job->country }}"
                                                            data-company="{{ $job->company }}"
                                                            data-description="{{ $job->description }}"
                                                            data-category="{{ $job->category }}"
                                                            data-job-type="{{ $job->job_type }}"
                                                            data-requirement="{{ $job->requirement }}"
                                                            data-how-to="{{ $job->how_to }}"
                                                            class="flex w-full items-center rounded-lg py-2 px-4 hover:bg-gray-400 dark:hover:bg-gray-600 dark:hover:text-white text-gray-700 dark:text-gray-200">
                                                            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg"
                                                                viewbox="0 0 20 20" fill="currentColor"
                                                                aria-hidden="true">
                                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" />
                                                            </svg>
                                                            Preview
                                                        </button>




                                                        <button type="button" data-modal-target="deleteModal"
                                                            data-modal-toggle="deleteModal"
                                                            data-job-id="{{ $job->id }}"
                                                            class="flex w-full items-center rounded-lg py-2 px-4 hover:bg-gray-200 dark:hover:bg-gray-600 text-red-500 dark:hover:text-red-700">
                                                            <svg class="w-4 h-4 mr-2" viewbox="0 0 14 15" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    fill="currentColor"
                                                                    d="M6.09922 0.300781C5.93212 0.30087 5.76835 0.347476 5.62625 0.435378C5.48414 0.523281 5.36931 0.649009 5.29462 0.798481L4.64302 2.10078H1.59922C1.36052 2.10078 1.13161 2.1956 0.962823 2.36439C0.79404 2.53317 0.699219 2.76209 0.699219 3.00078C0.699219 3.23948 0.79404 3.46839 0.962823 3.63718C1.13161 3.80596 1.36052 3.90078 1.59922 3.90078V12.9008C1.59922 13.3782 1.78886 13.836 2.12643 14.1736C2.46399 14.5111 2.92183 14.7008 3.39922 14.7008H10.5992C11.0766 14.7008 11.5344 14.5111 11.872 14.1736C12.2096 13.836 12.3992 13.3782 12.3992 12.9008V3.90078C12.6379 3.90078 12.8668 3.80596 13.0356 3.63718C13.2044 3.46839 13.2992 3.23948 13.2992 3.00078C13.2992 2.76209 13.2044 2.53317 13.0356 2.36439C12.8668 2.1956 12.6379 2.10078 12.3992 2.10078H9.35542L8.70382 0.798481C8.62913 0.649009 8.5143 0.523281 8.37219 0.435378C8.23009 0.347476 8.06631 0.30087 7.89922 0.300781H6.09922ZM4.29922 5.70078C4.29922 5.46209 4.39404 5.23317 4.56282 5.06439C4.73161 4.8956 4.96052 4.80078 5.19922 4.80078C5.43791 4.80078 5.66683 4.8956 5.83561 5.06439C6.0044 5.23317 6.09922 5.46209 6.09922 5.70078V11.1008C6.09922 11.3395 6.0044 11.5684 5.83561 11.7372C5.66683 11.906 5.43791 12.0008 5.19922 12.0008C4.96052 12.0008 4.73161 11.906 4.56282 11.7372C4.39404 11.5684 4.29922 11.3395 4.29922 11.1008V5.70078ZM8.79922 4.80078C8.56052 4.80078 8.33161 4.8956 8.16282 5.06439C7.99404 5.23317 7.89922 5.46209 7.89922 5.70078V11.1008C7.89922 11.3395 7.99404 11.5684 8.16282 11.7372C8.33161 11.906 8.56052 12.0008 8.79922 12.0008C9.03791 12.0008 9.26683 11.906 9.43561 11.7372C9.6044 11.5684 9.69922 11.3395 9.69922 11.1008V5.70078C9.69922 5.46209 9.6044 5.23317 9.43561 5.06439C9.26683 4.8956 9.03791 4.80078 8.79922 4.80078Z" />
                                                            </svg>
                                                            Delete
                                                        </button>

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach

                                        {{ $jobs->links() }}
                                    @endisset

                                </tbody>
                            </table>
                        </div>




                    </div>
                </div>
            </section>
            <!-- End block -->


            <!-- Create modal -->
            <div id="createJobModal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                        <!-- Modal header -->
                        <div
                            class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Add Job</h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-target="createJobModal" data-modal-toggle="createJobModal">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>

                        <!-- Post job Setting -->
                        @php
                            $jobType = [
                            'Fulltime',
                            'Internship',
                            'Opportunity',
                            ];

                            $countries = [
                            'Brunei',
                            'Cambodia',
                            'Indonesia',
                            'Laos',
                            'Malaysia',
                            'Myanmar',
                            'Philippines',
                            'Singapore',
                            'Thailand',
                            'Vietnam',
                            'Japan',
                            'United Kingdom',
                            'United States',
                            ];

                            $jobCategories = [
                            'Accounting',
                            'Administration',
                            'Banking and Financial Services',
                            'Customer Service',
                            'Creative and Design',
                            'Education and Training',
                            'Engineering and Construction',
                            'Healthcare',
                            'Human Resources',
                            'Information Technology',
                            'Legal',
                            'Manufacturing',
                            'Marketing and PR',
                            'Media and Communication',
                            'Real Estate',
                            'Retail',
                            'Sales',
                            'Science',
                            'Social Services',
                            'Tourism and Travel',
                            'Transport and Logistics',
                            ];

                            $selected = [

                            ];
                        @endphp


                        <!-- Modal body -->
                        <form
                            action="{{ route('empJob.store', [$id=Auth::user()->id]) }}"
                            method="post">
                            @csrf

                            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                <div class="sm:col-span-2">
                                    <label for="name"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Job
                                        Title</label>
                                    <input type="text" name="title" id="name"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Type job title" required="">
                                </div>

                                <div>
                                    <label for="brand"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
                                    <input type="text" name="city" id="brand"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Type City" required="">
                                </div>

                                <div>
                                    <label for="country"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country</label>
                                    <select id="category" name="country" required=""
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option value="" disabled selected>Select countries</option>
                                        @foreach($countries as $item)
                                            <option value="{{ $item }}"
                                                {{ in_array($item, $selected) ? 'selected' : '' }}>
                                                {{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="jobType"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Job
                                        Type</label>
                                    <select id="category" name="type" required=""
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option value="" disabled selected>Select jobtype</option>
                                        @foreach($jobType as $item)
                                            <option value="{{ $item }}"
                                                {{ in_array($item, $selected) ? 'selected' : '' }}>
                                                {{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="category"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                    <select id="category" name="category" required=""
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option value="" disabled selected>Select an option</option>
                                        @foreach($jobCategories as $item)
                                            <option value="{{ $item }}"
                                                {{ in_array($item, $selected) ? 'selected' : '' }}>
                                                {{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                    </select>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="description"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                    <textarea id="description" name="description" rows="4" required=""
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Write job description here"></textarea>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="description"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Requirement</label>
                                    <textarea id="description" name="requirement" rows="4" required=""
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Write job requirement here"></textarea>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="description"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">How To
                                        Apply</label>
                                    <textarea id="description" name="apply" rows="4" required=""
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Write How to apply job here"></textarea>
                                </div>

                            </div>
                            <button type="submit"
                                class="flex items-center justify-center inline-flex items-center px-4 py-2 text-sm font-medium text-center bg-purple-900 text-white rounded-lg hover:bg-purple-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="mr-1 -ml-1 w-6 h-6" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                Add new Job
                            </button>
                        </form>
                    </div>
                </div>
            </div>

    @isset($job)
    <!-- Update script  -->
    <script>
        var jobId;

        $(document).ready(function () {
        var previewButtons = document.querySelectorAll('[data-modal-target="updateJobModal"]');

        previewButtons.forEach(function (button) {
            button.addEventListener('click', function () {
            jobId = button.getAttribute('data-jobid');
            var jobTitle = button.getAttribute('data-title');
            var city = button.getAttribute('data-city');
            var country = button.getAttribute('data-country');
            var company = button.getAttribute('data-company');
            var description = button.getAttribute('data-description');
            var category = button.getAttribute('data-category');
            var jobType = button.getAttribute('data-job-type');
            var requirement = button.getAttribute('data-requirement');
            var howTo = button.getAttribute('data-how-to');

            // Set the modal form placeholders dynamically
            $('#updateJobModal #jobTitleInput').val(jobTitle);
            $('#updateJobModal #cityInput').val(city);
            $('#updateJobModal #countryInput') .val(country);
            $('#updateJobModal #companyInput').val(company);
            $('#updateJobModal #descriptionInput').val(description);
            $('#updateJobModal #categoryInput').val(category);
            $('#updateJobModal #jobTypeInput').val(jobType);
            $('#updateJobModal #requirementInput').val(requirement);
            $('#updateJobModal #howToInput').val(howTo);

            // Update form action
            var formAction = "{{ route('employer.job.update', ['id' => ':jobId']) }}";
            formAction = formAction.replace(':jobId', jobId);
            $('#updateForm').attr('action', formAction);
            });
        });
        });

        $(document).ready(function () {
        // Add confirmation before submitting the form
        $('#updateForm').submit(function (event) {
            event.preventDefault(); // Prevent the form from submitting initially

            // Show Tailwind CSS confirmation modal
            $('#confirmationModal').removeClass('hidden');

            // Handle confirmation and form submission
            $('#confirmBtn').click(function () {
            $('#updateForm').off('submit').submit(); // Unbind previous submit event and submit the form
            $('#confirmationModal').addClass('hidden'); // Hide the confirmation modal
            });

            // Handle cancel button click
            $('#cancelBtn').click(function () {
            $('#confirmationModal').addClass('hidden'); // Hide the confirmation modal
            });
        });
        });
    </script>
        @endisset

            <!-- Update modal -->
            <div id="updateJobModal" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-2xl max-h-full">

                <div class="modal-body">
                    <!-- Modal content -->
                    <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                        <!-- Modal header -->
                        <div
                            class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Update Job</h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-toggle="updateJobModal">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>

                        <!-- Modal body -->
                        <form id="updateForm" method="post">
                            @csrf
                            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                <div class="sm:col-span-2">
                                    <div>
                                        <label for="name"class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Job Title</label>
                                        <input type="title" required="" name="title" id="jobTitleInput" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    </div>
                                </div>

                                <div>
                                    <label for="city"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">City</label>
                                    <input type="text" name="city" id="cityInput" required=""
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        >
                                </div>

                                <div>
                                    <label for="country"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Country</label>
                                    <select id="category" name="country" required=""
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option value="" disabled selected>Select Country</option>
                                        @foreach($countries as $item)
                                            <option value="{{ $item }}"
                                                {{ in_array($item, $selected) ? 'selected' : '' }}>
                                                {{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="jobType"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Job
                                        Type</label>
                                    <select id="category" name="type" required=""
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option value="" disabled selected>Select jobtype</option>
                                        @foreach($jobType as $item)
                                            <option value="{{ $item }}"
                                                {{ in_array($item, $selected) ? 'selected' : '' }}>
                                                {{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="category"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                                    <select id="category" name="category" required=""
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        <option value="" disabled selected>Select an option</option>
                                        @foreach($jobCategories as $item)
                                            <option value="{{ $item }}"
                                                {{ in_array($item, $selected) ? 'selected' : '' }}>
                                                {{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                    </select>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="description"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                    <textarea id="descriptionInput" name="description" rows="4" required=""
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        ></textarea>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="requirement"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Requirement</label>
                                    <textarea id="requirementInput" name="requirement" rows="4" required=""
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Write job requirement here"></textarea>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="howTo"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">How To
                                        Apply</label>
                                    <textarea id="howToInput" name="apply" rows="4" required=""
                                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Write How to apply job here"></textarea>
                                </div>

                            </div>

                            <div class="flex items-center space-x-4">
                                <button type="submit"
                                    class="flex items-center justify-center inline-flex items-center px-4 py-2 text-sm font-medium text-center bg-purple-900 text-white rounded-lg hover:bg-purple-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update
                                    Job
                                </button>
                            </div>
                        </form>

                        <!-- Confirmation model  -->

                        <div id="confirmationModal" tabindex="-1"
                            class="flex items-center justify-center fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full h-auto max-w-md">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">

                                    <div class="p-6 text-center">
                                        <svg aria-hidden="true"
                                            class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you
                                            sure you want to update this job?</h3>
                                        <button id="cancelBtn"
                                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                                            cancel</button>
                                        <button id="confirmBtn"
                                            class="text-white bg-blue-500 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2">Yes,
                                            I'm sure</button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>


                </div>
            </div>
        </div>
    </div>

    <!-- Preview Script -->
    <script>
        var jobId;

        $(document).ready(function () {
            var previewButtons = document.querySelectorAll('[data-modal-target="readJobModal"]');

            previewButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    jobId = button.getAttribute('data-jobid');
                    var jobTitle = button.getAttribute('data-title');
                    var city = button.getAttribute('data-city');
                    var country = button.getAttribute('data-country');
                    var company = button.getAttribute('data-company');
                    var description = button.getAttribute('data-description');
                    var category = button.getAttribute('data-category');
                    var jobType = button.getAttribute('data-job-type');
                    var requirement = button.getAttribute('data-requirement');
                    var howTo = button.getAttribute('data-how-to');

                    // Combine city and country
                    var location = city + ', ' + country;

                    // Set the modal title dynamically
                    $('#readJobModal #modalTitle').text(jobTitle);
                    $('#readJobModal #location').text(location);
                    $('#readJobModal #company').text(company);
                    $('#readJobModal #description').text(description);
                    $('#readJobModal #category').text(category);
                    $('#readJobModal #jobtype').text(jobType);
                    $('#readJobModal #requirement').text(requirement);
                    $('#readJobModal #howto').text(howTo);

                     // Call the callback function passing the jobId
                    onJobIdAssigned(jobId, function(updatedJobId) {
                        // Use the updatedJobId, if any processing is needed
                        console.log("Job ID assigned:", updatedJobId);
                    });
                });
            });
        });


        var detailsRoute = "{{ route('employer.job.detail', ['id' => ':id']) }}";

        function redirectToJobDetail() {
            // Use the job from the callback
            onJobIdAssigned(jobId, function(updatedJobId) {
                window.location.href = detailsRoute.replace(':id', updatedJobId);
            });
        }

        // Callback function
        function onJobIdAssigned(job, callback) {
            // Any processing or validation can be done here
            // For now, we're just passing the job back
            callback(job);
        }


    </script>


    <!-- Read modal -->
    <div id="readJobModal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-xl max-h-full">
            <!-- Modal content -->
            <div class="modal-body">
                <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                    <!-- Modal header -->
                    <div class="flex justify-between mb-4 rounded-t sm:mb-5">
                        <div class="text-lg text-gray-900 md:text-xl dark:text-white">
                            <h1 class="font-bold" id="modalTitle"></h1>
                            <p class="text-sm" id="location"></p>
                            <p class="text-sm" id="company"></p>
                        </div>
                        <div>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 inline-flex dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-toggle="readJobModal">
                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>

                        </div>
                    </div>
                    <dl>
                        <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Description</dt>
                        <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400" id="description"></dd>
                        <div class="flex mb-4">
                            <div class="mr-4">
                                <dt class="font-semibold leading-none text-gray-900 dark:text-white">Category</dt>
                                <dd class="font-light text-gray-500 sm:mb-5 dark:text-gray-400" id="category"></dd>
                            </div>
                            <div>
                                <dt class="font-semibold leading-none text-gray-900 dark:text-white">Type</dt>
                                <dd class="font-light text-gray-500 sm:mb-5 dark:text-gray-400" id="jobtype"></dd>
                            </div>
                        </div>

                        <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Requirement</dt>
                        <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400" id="requirement"></dd>

                        <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">How to Apply</dt>
                        <dd class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400" id="howto"></dd>


                    </dl>

                    @isset($job)
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-3 sm:space-x-4">
                        <button type="button" onclick="redirectToJobDetail('{{ route('employer.job.detail', [$id=$job->id]) }}')"
                                class="flex items-center justify-center inline-flex items-center px-4 py-2 text-sm font-medium text-center bg-purple-900 text-white rounded-lg hover:bg-purple-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">View Details</button>
                        </div>
                    </div>
                   @endisset
                </div>
            </div>
        </div>
    </div>




    <!-- Delete modal -->
    <div id="deleteModal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">

            <!-- Modal content -->
            <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <button type="button"
                    class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="deleteModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <!-- svg path -->
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true"
                    fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                        clip-rule="evenodd" />
                </svg>
                <p class="mb-4 text-gray-500 dark:text-gray-300">Are you sure you want to delete this item?</p>
                <div class="flex justify-center items-center space-x-4">
                    <button data-modal-toggle="deleteModal" type="button"
                        class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                        cancel</button>
                    <!-- Add this form for the delete button -->
                    <form id="deleteForm" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">Yes,
                            I'm sure</button>
                    </form>
                    <!-- End of form -->



                    <!-- Delete script  -->
                    <script>
                        $(document).ready(function () {
                            var deleteButtons = document.querySelectorAll('[data-modal-target="deleteModal"]');

                            deleteButtons.forEach(function (button) {
                                button.addEventListener('click', function () {
                                    var jobId = button.getAttribute('data-job-id');
                                    var deleteForm = document.getElementById('deleteForm');

                                    // Update the form action with the jobId
                                    var formAction =
                                        "{{ route('employer.job.destroy', ['userId' => Auth::user()->id, 'jobId' => ':jobId']) }}";
                                    formAction = formAction.replace(':jobId', jobId);
                                    deleteForm.action = formAction;
                                });
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>


    </div>
    </div>
</x-app-layout>
