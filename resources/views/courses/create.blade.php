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
                        <a href="{{ route('courses.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Back</a>
                    </div>

                    <hr class="mt-4 mb-4">

                    <form id="create" action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input type="text" name="name" id="name" class="block mt-1 w-full" :value="old('name')" placeholder="Enter course name" autofocus required/>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="course_file" :value="__('Course File')" />
                            <x-text-input type="file" name="course_file" id="course_file" accept=".zip, .rar, .pdf, .doc, .docx" class="block mt-1 w-full border border-transparent p-1" :value="old('course_file')" required/>
                            <x-input-error :messages="$errors->get('course_file')" class="mt-2" />
                        </div>

                        <hr class="mt-4 mb-4">

                        <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>