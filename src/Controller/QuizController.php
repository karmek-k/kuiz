<?php

namespace App\Controller;

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
    public function quiz_list(QuizRepository $quizRepository): Response
    {
        $quizzes = $quizRepository->findAll();

        return $this->render('quiz/index.html.twig', [
            'quizzes' => $quizzes
        ]);
    }
}
