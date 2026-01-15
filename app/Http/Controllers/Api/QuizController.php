<?php

namespace App\Http\Controllers\Api; // Check this line carefully!

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\Question;
use App\Models\QuizResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function getQuestions($lectureId)
    {
        $questions = Question::where('lecture_id', $lectureId)
            ->with(['options' => function($query) {
                $query->select('id', 'question_id', 'option_text');
            }])
            ->get();

        return response()->json(['data' => $questions]);
    }

    public function submit(Request $request)
    {
        $request->validate([
            'lecture_id' => 'required|exists:lectures,id',
            'answers' => 'required|array', 
        ]);

        $score = 0;
        $totalQuestions = Question::where('lecture_id', $request->lecture_id)->count();
        
        foreach ($request->answers as $questionId => $optionId) {
            $isCorrect = Option::where('id', $optionId)
                ->where('question_id', $questionId)
                ->where('is_correct', true)
                ->exists();

            if ($isCorrect) {
                $score++;
            }
        }

        $percentage = $totalQuestions > 0 ? round(($score / $totalQuestions) * 100) : 0;

        $result = QuizResult::create([
            'user_id' => Auth::id(),
            'lecture_id' => $request->lecture_id,
            'score' => $score,
            'total_questions' => $totalQuestions,
        ]);

        return response()->json([
            'data' => [
                'score' => $score,
                'total' => $totalQuestions,
                'percentage' => $percentage
            ]
        ]);
    }
}