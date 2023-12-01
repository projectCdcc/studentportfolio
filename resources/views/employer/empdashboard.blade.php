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
                <div class="bg-success-500 text-white p-4 rounded-md" id="alert_shown">
                    Successfully logged in!
                </div>

                <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                <script>
                    $(document).ready(function() {
                        setTimeout(function() {
                            $('#alert_shown').fadeOut(500); // Set the fadeOut duration to 500 milliseconds (0.5 seconds)
                        }, 3000); // Set the timeout to 3000 milliseconds (3 seconds)
                    });
                </script>

                @php session()->forget('alert_shown') @endphp
            @endif
            
            <x-employer-profile-card>

            </x-employer-profile-card>
        </div>
    </div>
</x-app-layout>
