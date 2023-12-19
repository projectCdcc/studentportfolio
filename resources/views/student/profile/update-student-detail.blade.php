<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Student Details') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Please fill the your details information below.") }}
        </p>
    </header>

    <!-- Post job Setting
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

        $selected = [

        ];
    @endphp -->

    <form method="post" action="{{ route('student.detail.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="major" :value="__('Major / Field of Study')" />
            <x-text-input id="major" name="major" type="text" class="mt-1 block w-full" :value="old('name', $student->major)" required autofocus autocomplete="major" />
            <x-input-error class="mt-2" :messages="$errors->get('major')" />
        </div>

        <div class="mt-4">
            <x-input-label for="country" :value="__('Graduation Date:')" />
            <input type="date"  name="graduate_date"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
            <x-input-error class="mt-2" :messages="$errors->get('gradate_date')" />
        </div>


        <div class="mt-4">
            <x-input-label for="about" :value="__('About me')" />
            <textarea id="about" name="about_me" rows="4" :value="old('about_me', $student->about_me)" class="mt-1 block w-full text-l text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" ></textarea>
            <x-input-error class="mt-2" :messages="$errors->get('about')" />
        </div>


        <div class="flex items-center gap-4">
            <x-detail-button>{{ __('Save') }}</x-detail-button>

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
