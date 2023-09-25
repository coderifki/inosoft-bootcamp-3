<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class StudentController extends Controller
{
    public function index()
    {
        // Mengambil semua data siswa beserta detail nilai mata pelajaran
        $students = Student::all();

        $formattedStudents = [];
        foreach ($students as $student) {
            $formattedStudents[] = $student->getFormattedData();
        }

        return response()->json($formattedStudents, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        // Membuat data siswa baru
        $student = Student::create($request->all());

        return response()->json($student, 201);
    }

    // public function show($id)
    // {
    //     // Mengambil detail data siswa beserta detail nilai mata pelajaran berdasarkan ID
    //     $student = Student::findOrFail($id);

    //     return response()->json($student);
    // }

    public function show($id)
    {
        $student = Student::findOrFail($id);

        return response()->json($student->getFormattedData(), Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        // Mengupdate data siswa berdasarkan ID
        $student = Student::findOrFail($id);
        $student->update($request->all());

        return response()->json($student, 200);
    }

    public function destroy($id)
    {
        // Menghapus data siswa berdasarkan ID
        Student::findOrFail($id)->delete();

        return response()->json(['message' => 'Siswa berhasil dihapus']);
    }

    public function calculateAverageScore(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $averageScore = $student->calculateAverageScore();

        return response()->json(['average_score' => $averageScore]);
    }
}
