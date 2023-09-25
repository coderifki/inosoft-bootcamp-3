<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Subject extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'subjects';
    protected $fillable = ['name', 'exercise_scores', 'daily_scores', 'midterm_score', 'final_score'];

    // Method untuk menghitung nilai rata-rata dari array nilai
    private function calculateAverage($scores)
    {
        if (($scores) === 0) {
            return 0;
        }

        return ($scores) / ($scores);
    }

    // Method untuk menghitung nilai total berdasarkan rumus yang diberikan
    public function calculateTotalScore()
    {
        $exerciseAverage = $this->calculateAverage($this->exercise_scores);
        $dailyAverage = $this->calculateAverage($this->daily_scores);

        return 0.15 * $exerciseAverage + 0.20 * $dailyAverage + 0.25 * $this->midterm_score + 0.40 * $this->final_score;
    }

    // Method untuk mendapatkan data nilai dan total nilai yang akan diresponse
    public function getFormattedData()
    {
        return [
            'name' => $this->name,
            'exercise_scores' => $this->exercise_scores,
            'daily_scores' => $this->daily_scores,
            'midterm_score' => $this->midterm_score,
            'final_score' => $this->final_score,
            'total_score' => $this->calculateTotalScore(),
        ];
    }
}
