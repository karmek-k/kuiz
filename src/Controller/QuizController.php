<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\Quiz;
use App\Form\QuestionType;
use App\Repository\QuizRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuizController extends AbstractController
{
    /**
     * @Route("/quizzes", name="quiz_list")
     * @param QuizRepository $quizRepository
     * @return Response
     */
    public function quizList(QuizRepository $quizRepository): Response
    {
        // TODO: pagination
        $quizzes = $quizRepository->findAll();

        return $this->render('quiz/index.html.twig', [
            'quizzes' => $quizzes
        ]);
    }

    /**
     * @Route("/quiz/{id}", name="quiz_single")
     * @param Quiz $quiz
     * @return Response
     */
    public function quiz(Quiz $quiz): Response
    {
        return $this->render('quiz/quiz.html.twig', [
            'quiz' => $quiz
        ]);
    }

    /**
     * @Route("/quiz/{id}/form", name="quiz_form")
     * @param Quiz $quiz
     * @return Response
     */
    public function quizForm(Quiz $quiz): Response
    {
        $om = $this->getDoctrine()->getManager();
        $question = $om->find(Question::class, 1);

        $form = $this->createForm(QuestionType::class, $question);

        return $this->render('quiz/form.html.twig', [
            'quiz' => $quiz,
            'form' => $form->createView(),
        ]);
    }
}
