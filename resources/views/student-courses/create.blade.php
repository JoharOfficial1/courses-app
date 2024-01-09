<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Courses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <a href="{{ route('student-courses.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Back</a>
                    </div>

                    <hr class="mt-4 mb-4">

                    <form id="create" action="{{ route('student-courses.store') }}" method="POST">
                        @csrf

                        <div>
                            <x-input-label for="roll_number" :value="__('Roll Number')" />
                            <x-text-input type="text" name="roll_number" id="roll_number" class="block mt-1 w-full" :value="old('roll_number')" autofocus required/>
                            <x-input-error :messages="$errors->get('roll_number')" class="mt-2" />
                        </div>

                        <div class="mt-3">
                            <x-input-label for="serial_number" :value="__('Serial Number')" />
                            <x-text-input type="text" name="serial_number" id="serial_number" class="block mt-1 w-full" :value="old('serial_number')" autofocus required/>
                            <x-input-error :messages="$errors->get('serial_number')" class="mt-2" />
                        </div>

                        <div class="mt-3">
                            <x-input-label for="course" :value="__('Course')" />
                            <select class="form-select" id="course" name="course">
                                <option value="">Select Course</option>

                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('course')" class="mt-2" />
                        </div>

                        <hr class="mt-4 mb-4">

                        <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>