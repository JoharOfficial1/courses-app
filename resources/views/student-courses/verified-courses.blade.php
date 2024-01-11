<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Pakistan Institute of Advanced Technical Studies') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />
        
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div class="mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <div class="flex justify-center">
                    <img src="{{ asset('logo.png') }}" class="h-20 fill-current text-gray-500" alt="Company Logo" />
                </div>

                <div class="mt-4">
                    <div class="max-w-7xl mx-auto">
                        @include('messages.messages')
                    </div>
                </div>

                <div class="mt-3">
                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 text-gray-900">
                                    <table id="myTable" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Roll Number</th>
                                                <th>Serial Number</th>
                                                <th>Course Name</th>
                                                <th>Course File</th>
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
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<script>
    $("#myTable").DataTable();
</script>
