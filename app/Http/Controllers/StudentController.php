<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $title = "Sistem Sekolah - Daftar Siswa";
        $students = Student::select('id', 'nis', 'name', 'gender', 'class', 'major')->get();


        return view('students.index', [
            'title' => $title,
            'students' => $students
        ]);
    }
    public function show(Student $student)
    {
         $title = "Sistem Sekolah - Detail Siswa";

        return view('students.show', [
            'title' => $title,
            'student' => $student
        ]);
    }
    public function create()
    {
        
         $title = "Sistem Sekolah - Tambah Siswa";
        return view('students.create', [
            'title' => $title
        ]);          
    }
    public function edit(Student $student)
    {
        $title = "Sistem Sekolah - Edit Siswa";

        return view('students.edit', [
            'title' => $title,
            'student' => $student
        ]);
    }
    public function store(Request $request)
    {
        //vlaidasi data
        $validatedRequest = $request->validate([
            'nis' => ['required','string','size:4','unique:students,nis'],
            'name' => ['required','string'],
            'gender' => ['required','string','in:Laki-laki,Perempuan'],
            'major' => ['required','string','in:TKJ,AKL,BiD'],
            'class' => ['required','string']
        ]);

        //Tambahkan data ke database
        Student::create($validatedRequest);

        //handle if success
        return redirect()->route('students.index');
    }
    public function update(Request $request, $id)
    {
        return "Proses update siswa dengan id: " . $id;
    }
    public function destroy($id)
    {
        return "Proses hapus siswa dengan id: " . $id;
    }
}
