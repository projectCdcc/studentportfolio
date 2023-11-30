<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="pb-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                {{-- alert with timer --}}
                @if (session()->has('alert_shown'))
                    <x-bladewind.alert type="success">
                        Successfully logged in!
                    </x-bladewind.alert>

                    <script>
                        setTimeout(function() {
                            document.getElementById('alert_shown').style.display = 'none';
                        }, 500);
                    </script>

                    @php session()->forget('alert_shown') @endphp
                @endif


            <x-employer-profile-card>

            </x-employer-profile-card>
        </div>
    </div>
</x-app-layout>
