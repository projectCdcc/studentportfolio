<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Organization Details') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Please fill the organization's details and location below.") }}
        </p>
    </header>

    <form method="post" action="{{ route('orgDetail.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

    <div class="grid grid-cols-2 gap-4">
        <div>
            <x-input-label for="org_type" :value="__('Organization Type')" />
            <x-text-input id="org_type" name="org_type" type="text" class="mt-1 block w-full" :value="old('org_type', 'Organization type')" required autofocus autocomplete="org_type" />
            <x-input-error class="mt-2" :messages="$errors->get('org_type')" />
        </div>

        <div>
            <x-input-label for="street" :value="__('Street')" />
            <x-text-input id="street" name="street" type="text" class="mt-1 block w-full" :value="old('street', 'Street')" required autofocus autocomplete="street" />
            <x-input-error class="mt-2" :messages="$errors->get('street')" />
        </div>

        <div>
            <x-input-label for="city" :value="__('City')" />
            <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city', 'City')" required autofocus autocomplete="city" />
            <x-input-error class="mt-2" :messages="$errors->get('city')" />
        </div>

        <div>
            <x-input-label for="country" :value="__('Country')" />
            <x-text-input id="country" name="country" type="text" class="mt-1 block w-full" :value="old('country', 'Country')" required autofocus autocomplete="country" />
            <x-input-error class="mt-2" :messages="$errors->get('country')" />
        </div>
    </div>

    <div class="mt-4">
        <x-input-label for="country" :value="__('Established in')" />
        <x-text-input id="country" name="establish_year" type="text" class="mt-1 block w-full" :value="old('country', 'Year')" required autofocus autocomplete="country" />
        <x-input-error class="mt-2" :messages="$errors->get('country')" />
    </div>

    <div class="mt-4">
        <x-input-label for="about" :value="__('About')" />
        <textarea id="about" name="about" rows="4" class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="About here..."></textarea>
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