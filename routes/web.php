<?php

use App\Http\Controllers\SchoolClass\CreateController;
use App\Http\Controllers\SchoolClass\DestroyController;
use App\Http\Controllers\SchoolClass\EditController;
use App\Http\Controllers\SchoolClass\IndexController;
use App\Http\Controllers\SchoolClass\ShowController;
use App\Http\Controllers\SchoolClass\StoreController;
use App\Http\Controllers\SchoolClass\UpdateController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});


//autentikasi
Route::get('/login', [AuthController::class, 'LoginView'])->name('login-view');
Route::post('/login', [AuthController::class, 'LoginPost'])->name('login-post');
Route::get('/register', [AuthController::class, 'RegisterView'])->name('register-view');
Route::post('/register', [AuthController::class, 'RegisterPost'])->name('register-post');



// Manajemen Data Siswa (Action Controller Method)
Route::name('students.')->prefix('students')->group(function () {
    // Halaman daftar siswa
    Route::get('/', [StudentController::class, 'index'])->name('index');
    
    // Halaman tambah siswa (PINDAHKAN KE ATAS & HAPUS whereNumber yang salah)
    Route::get('/create', [StudentController::class, 'create'])->name('create');
    
    // Halaman detail siswa
    Route::get('/{student}', [StudentController::class, 'show'])->name('show')->whereNumber('student'); 
    // Catatan: Kalau parameter di controller kamu $student, ganti whereNumber('id') jadi whereNumber('student') atau biarkan jika pakai ID.

    // Halaman edit siswa
    Route::get('/{student}/edit', [StudentController::class, 'edit'])->name('edit');
    
    // Halaman menambah siswa (store)
    Route::post('/store', [StudentController::class, 'store'])->name('store');
    
    // Halaman update siswa
    Route::put('/{student}/update', [StudentController::class, 'update'])->name('update');
    
    // Halaman hapus siswa
    Route::delete('/{student}/destroy', [StudentController::class, 'destroy'])->name('destroy');
});

// Manajemen Data Guru (Action Controller Method)
Route::name('teachers.')->prefix('teachers')->group(function() {
Route::get('/', [TeacherController::class, 'index'])->name('index');
Route::get('/create', [TeacherController::class, 'create']  )->name('create');
// Halaman tambah guru
Route::get('/{id}', [TeacherController::class, 'show'])->name('show');
// Halaman edit guru
Route::get('/{id}/edit', [TeacherController::class, 'edit'])->name('edit');
// Halaman menambah guru
Route::post('/store', [TeacherController::class, 'store'])->name('store');
// Halaman update guru
Route::put('/{id}/update', [TeacherController::class, 'update'])->name('update');
// Halaman hapus guru   
Route::delete('/{id}/destroy', [TeacherController::class, 'destroy'])->name('destroy');
});

// Manajemen Data Kelas (Invokable Controller)
Route::name('classes.')->prefix('classes')->group(function() {

Route::get('/', IndexController::class)->name('index');
// Halaman detail kelas
Route::get('/create', CreateController::class)->name('create');
// Halaman tambah kelas
Route::get('/{id}', ShowController::class)->name('show');
// Halaman edit kelas
Route::get('/{id}/edit', EditController::class)->name('edit');
// Halaman menambah kelas
Route::post('/store', StoreController::class)->name('store');
// Halaman update kelas
Route::put('/{id}/update', UpdateController::class)->name('update');
// Halaman hapus kelas
Route::delete('/{id}/destroy', DestroyController::class)->name('destroy');

});

// Manajemen Jurusan Siswa (Resource Controller)
Route::resource('majors', \App\Http\Controllers\MajorController::class);