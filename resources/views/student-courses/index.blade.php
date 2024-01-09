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
                    <div class="text-end">
                        <a href="{{ route('student-courses.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Create Student Course</a>
                    </div>

                    <hr class="mt-4 mb-4">

                    <table id="myTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Roll Number</th>
                                <th>Serial Number</th>
                                <th>Course Name</th>
                                <th>Course File</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($studentCourses as $studentCourse)
                                <tr>
                                    <td>{{ $studentCourse->roll_number }}</td>
                                    <td>{{ $studentCourse->serial_number }}</td>
                                    <td>{{ $studentCourse->course->name }}</td>
                                    <td>
                                        <a href="{{ asset($studentCourse->course->course_file) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" download>Download</a>
                                    </td>
                                    <td>
                                        <a href="{{ route('student-courses.edit', [$studentCourse->id]) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Edit</a>

                                        <a href="javascript::void(0)" onclick="$('#destroy'+{!!$studentCourse->id!!}).submit()" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Delete</a>

                                        <form id="destroy{{$studentCourse->id}}" action="{{ route('student-courses.destroy', [$studentCourse->id]) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    $("#myTable").DataTable();
</script>
