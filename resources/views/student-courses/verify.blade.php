<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('student-courses.verify') }}">
        @csrf

        <div class="mt-3">
            <x-input-label for="search_type" :value="__('Search Type')" />
            <select class="form-select w-full" id="search_type" name="search_type" required>
                <option value="">Select search type</option>
                <option value="roll_number" @if(old('search_type') == 'roll_number') selected @endif>Roll Number</option>
                <option value="serial_number" @if(old('search_type') == 'serial_number') selected @endif>Serial Number</option>
            </select>
            <x-input-error :messages="$errors->get('search_type')" class="mt-2" />
        </div>

        <div class="mt-3">
            <x-input-label for="number" :value="__('Number')" />
            <x-text-input type="text" name="number" id="number" class="block mt-1 w-full" :value="old('number')" placeholder="Enter number to search" required />
            <x-input-error :messages="$errors->get('number')" class="mt-2" />
        </div>

        <hr class="mt-3">

        <div class="flex items-center justify-center mt-4">
            <x-primary-button class="ms-3">
                {{ __('Search') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
