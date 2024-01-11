<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseVerifyController;
use App\Http\Controllers\StudentCourseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('student-courses.verify');
});

Route::get('/admin', function () {
    if (Auth::user()) {
        return redirect()->route('courses.index');
    } else {
        return view('auth.login');
    }
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('courses', CourseController::class);
});

Route::post('verify', [StudentCourseController::class, 'verify'])->name('student-courses.verify');
Route::resource('student-courses', StudentCourseController::class)->middleware('auth')->except([
    'verify',
]);

require __DIR__.'/auth.php';
