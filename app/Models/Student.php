<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Student extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'students';
    protected $fillable = ['name', 'subjects'];

    public function subjects()
    {
        return $this->embedsMany(Subject::class);
    }

    // Method untuk menghitung nilai rata-rata total dari semua mata pelajaran
    public function calculateAverageScore()
    {
        $totalScores = 0;
        $totalSubjects = count($this->subjects);

        foreach ($this->subjects as $subject) {
            $totalScores += $subject->calculateTotalScore();
        }

        return $totalScores / $totalSubjects;
    }

    // Method untuk mendapatkan data siswa dan detail nilai mata pelajaran
    public function getFormattedData()
    {
        $subjectData = [];

        foreach ($this->subjects as $subject) {
            $subjectData[] = $subject->getFormattedData();
        }

        return [
            'name' => $this->name,
            'subjects' => $subjectData,
            'average_score' => $this->calculateAverageScore(),
        ];
    }
}
