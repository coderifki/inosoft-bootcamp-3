<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubjectController extends Controller
{

    public function index()
    {
        // Mengambil semua data mata pelajaran
        $subjects = Subject::all();

        $formattedSubjects = [];
        foreach ($subjects as $subject) {
            $formattedSubjects[] = $subject->getFormattedData();
        }

        return response()->json($formattedSubjects, Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        // Membuat data mata pelajaran baru
        $subject = Subject::create($request->all());

        return response()->json($subject, 201);
    }

    public function show($id)
    {
        // Mengambil detail data mata pelajaran berdasarkan ID
        $subject = Subject::findOrFail($id);

        return response()->json($subject->getFormattedData(), Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        // Mengupdate data mata pelajaran berdasarkan ID
        $subject = Subject::findOrFail($id);
        $subject->update($request->all());

        return response()->json($subject, 200);
    }

    public function destroy($id)
    {
        // Menghapus data mata pelajaran berdasarkan ID
        Subject::findOrFail($id)->delete();

        return response()->json(['message' => 'Mata pelajaran berhasil dihapus']);
    }

    public function calculateTotalScore(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);
        $totalScore = $subject->calculateTotalScore();

        return response()->json(['total_score' => $totalScore]);
    }
}
