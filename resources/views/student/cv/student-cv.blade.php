<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Upload CV') }}
        </h2>
    </x-slot>


    <div class="pb-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
            <div class="lg:flex lg:space-x-6">
                <!-- Student Profile Card -->
                <div class="lg:w-1/3">
                    <x-student-profile-card>
                    </x-student-profile-card>
                </div>


                <div class="lg:w-2/3">
                    <div class="card mb-4">
                        <div class="container">
                            <div class="text-center">
                                <h3 class="text-2xl">Upload CV Here</h3>
                                <p class="lead">PLease upload the cv in pdf format only.</p>
                            </div>

                            <div class="border-t-2 border-gray-500 bg-white my-4 shadow-xl shadow-gray-100 w-full max-w-4xl flex flex-col sm:flex-row gap-3 sm:items-center  justify-between px-5 py-4 rounded-md">
                                <div class="bg-white my-4 shadow-xl shadow-gray-100 w-full max-w-4xl flex flex-col sm:flex-row gap-3 sm:items-center justify-between px-5 py-4 rounded-md">
                                    <form action="{{ route('student.cv.upload', ['id' => Auth::user()->id])}}" method="post" enctype="multipart/form-data" class="flex-grow">
                                        @csrf
                                        <div class="flex items-center">
                                            <div class="mr-3 flex-grow">
                                                <label for="avatar" class="block text-sm font-medium text-gray-700">Upload CV Here</label>
                                                <input type="file" class="mt-1 p-2 border rounded-md w-full focus:outline-none focus:none @error('cv') border-red-500 @enderror" name="cv" value="{{ old('cv') }}" required autocomplete="avatar">
                                                @error('success')
                                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div>
                                                <button class="mt-4 px-4 py-2 bg-purple-900 text-white rounded-md hover:bg-purple-700 focus:outline-none focus:bg-purple-600" type="submit">Upload CV</button>
                                            </div>
                                        </div>

                                        <div class="text-red-600 my-8 flex text-left">
                                            <p class="lead">Your posted cv file will display here.</p>
                                        </div>

                                        @if(isset($cv))
                                            <div class="my-8 flex items-center">
                                                <div style="width: 100%; overflow-x: auto;">
                                                    <embed src="/cv/{{$cv->attachment}}" style="width: 100%; height: 1100px;" type="application/pdf">
                                                </div>
                                            </div>
                                        @else
                                            <p></p>
                                        @endif

                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
