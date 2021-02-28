<?php


namespace App\Service;


use App\Entity\Quiz;

class QuizGrader
{
    /**
     * Returns an array that associates questions' IDs
     * with user's scores.
     *
     * @param Quiz $quiz
     * @return array
     */
    public function grade(Quiz $quiz): array
    {
        $scores = [];

        foreach ($quiz->getQuestions() as $question) {
            $score = 0;

            foreach ($question->getQuestionAnswers() as $answer) {
                $answer->getIsCorrect() ? ++$score : --$score;
            }

            $scores[] = $score;
        }

        return $scores;
    }
}