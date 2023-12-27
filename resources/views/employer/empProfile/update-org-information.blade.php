<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Organization Details') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Please fill the organization's details and location below.") }}
        </p>
    </header>

    <!-- Post job Setting -->
    @php
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

        $organizationType = [
        'Education',
        'Healthcare',
        'Government',
        'Information Technology',
        'Nonprofit',
        'Manufacturing',
        'Retail',
        'Finance',
        'Hospitality',
        'Real Estate',
        'Transportation and Logistics',
        'Media and Entertainment',
        'Energy and Utilities',
        'Construction',
        'Telecommunications',
        'Legal Services',
        'Agriculture and Forestry',
        'Mining and Metals',
        'Environmental Services',
        'Research and Development',
        'Religious Organization'];


        $selected = [

        ];
    @endphp

    <form method="post" action="{{ route('orgDetail.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

    <div class="grid grid-cols-2 gap-4">
        <div>
            <x-input-label for="org_type" :value="__('Organization Type')" />

            <select id="org_type" name="org_type" required
                    class="mt-2 block w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                    onchange="toggleOtherInput()">
                @if($employer->country)
                    <option selected value="{{ $employer->org_type }}">{{ $employer->org_type }}</option>
                @else
                    <option selected disabled>Organization Type</option>
                @endif

                @foreach($organizationType as $item)
                    <option value="{{ $item }}" {{ in_array($item, $selected) ? 'selected' : '' }}>
                        {{ $item }}
                    </option>
                @endforeach
                <option id="otherOption" value="other">Other...</option>
            </select>

            <input type="text" id="otherInput" class="mt-2 block w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" style="display:none;" placeholder="Organization Type" oninput="updateOtherOption()">

            <x-input-error class="mt-2" :messages="$errors->get('country')" />
        </div>

        <script>
            function toggleOtherInput() {
                var selectBox = document.getElementById('org_type');
                var otherInput = document.getElementById('otherInput');
                otherInput.style.display = selectBox.value === 'other' ? 'block' : 'none';
            }

            function updateOtherOption() {
                var otherInput = document.getElementById('otherInput');
                var otherOption = document.getElementById('otherOption');
                if (otherInput.value.trim() !== '') {
                    otherOption.value = otherInput.value;
                } else {
                    otherOption.value = 'other';
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                toggleOtherInput();
            });
        </script>

        <div>
            <x-input-label for="street" :value="__('Street')" />
            <x-text-input id="street" name="street" type="text" class="mt-1 block w-full text-gray-400" :value="old('street', $employer->street)" required autofocus autocomplete="street" />
            <x-input-error class="mt-2" :messages="$errors->get('street')" />
        </div>

        <div>
            <x-input-label for="city" :value="__('City')" />
            <x-text-input id="city" name="city" type="text" class="mt-1 block w-full text-gray-400" :value="old('city', $employer->city)" required autofocus autocomplete="city" />
            <x-input-error class="mt-2" :messages="$errors->get('city')" />
        </div>

        <div>
            <x-input-label for="country" :value="__('Country')" />
            <select id="category" name="country" required=""
                class="mt-2 block w-full text-sm text-gray-900 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @if($employer->country)
                    <option selected value="{{ $employer->country }}">{{ $employer->country }}</option>
                @else
                    <option selected disabled>Select Country</option>
                @endif

                    @foreach($countries as $item)
                        <option value="{{ $item }}"
                        {{ in_array($item, $selected) ? 'selected' : '' }}>
                        {{ $item }}
                        </option>
                    @endforeach
                </select>
            <x-input-error class="mt-2" :messages="$errors->get('country')" />
        </div>

    </div>

    <div class="mt-4">
        <x-input-label for="country" :value="__('Established in')" />
        <x-text-input id="country" name="establish_year" type="text" class="mt-1 block w-full text-gray-400" :value="old('date', $employer->establish_year)" required autofocus autocomplete="country" />
        <x-input-error class="mt-2" :messages="$errors->get('country')" />
    </div>

    <!-- Phone and Website-->
    <div class="grid grid-cols-2 gap-4">
        <div>
            <x-input-label for="phone" :value="__('Phone')" />
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 top-0 flex items-center ps-3.5 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 19 18">
                            <path d="M18 13.446a3.02 3.02 0 0 0-.946-1.985l-1.4-1.4a3.054 3.054 0 0 0-4.218 0l-.7.7a.983.983 0 0 1-1.39 0l-2.1-2.1a.983.983 0 0 1 0-1.389l.7-.7a2.98 2.98 0 0 0 0-4.217l-1.4-1.4a2.824 2.824 0 0 0-4.218 0c-3.619 3.619-3 8.229 1.752 12.979C6.785 16.639 9.45 18 11.912 18a7.175 7.175 0 0 0 5.139-2.325A2.9 2.9 0 0 0 18 13.446Z"/>
                        </svg>
                    </div>
                    <input :value="old('phone', $employer->phone)" type="text" name="phone" id="phone-input" aria-describedby="helper-text-explanation" class="mt-1 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="063-001-7890" required>
                </div>
            <p id="helper-text-explanation" class="mt-2 text-xs text-gray-500 dark:text-gray-400">Example: 0638741234. Rewrite in 063-874-1234</p>
            <x-input-error class="mt-2" :messages="$errors->get('org_type')" />
        </div>

        <div>
            <x-input-label for="org_type" :value="__('WebSite:')" />
            <x-text-input id="org_type" name="website" type="text" class="mt-1 block w-full text-gray-400" :value="old('website', $employer->website)" required autofocus autocomplete="org_type" />
            <x-input-error class="mt-2" :messages="$errors->get('org_type')" />
        </div>

    </div>


    <div class="mt-4">
        <x-input-label for="about" :value="__('About')" />
        <textarea id="about" name="about" rows="4" class="mt-1 block w-full text-l text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="{{ $employer->about }}"></textarea>
        <x-input-error class="mt-2" :messages="$errors->get('about')" />
    </div>


        <div class="flex items-center gap-4">
            <x-org-button>{{ __('Save') }}</x-org-button>

            @if (session('update') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>

            @endif
        </div>
    </form>
</section>

