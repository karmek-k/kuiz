<?php

namespace App\DataFixtures;

use App\Entity\Question;
use App\Entity\QuestionAnswer;
use App\Entity\Quiz;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class QuizFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    private function createQuestion(ObjectManager $manager, Quiz $quiz, string $name, array $answers)
    {
        $question = new Question();
        $question->setQuiz($quiz);
        $question->setName($name);

        foreach ($answers as $answerText => $isCorrect) {
            $answer = new QuestionAnswer();
            $answer->setText($answerText);
            $answer->setIsCorrect($isCorrect);
            $answer->setQuestion($question);

            $manager->persist($answer);
        }

        $manager->persist($question);
    }

    public function load(ObjectManager $manager)
    {

        $quiz = new Quiz();
        $quiz->setName('PHP Quiz');
        $quiz->setDescription('How proficient are you in PHP?');

        $quizAuthor = new User();
        $quizAuthor->setUsername('php_quiz_author');
        $quizAuthor->setPassword(
            $this->encoder->encodePassword($quizAuthor, '12345')
        );

        $quiz->setAuthor($quizAuthor);

        // questions are persisted by this method
        $this->createQuestion(
            $manager,
            $quiz,
            'What is the most popular PHP framework?',
            [
                'Symfony' => false,
                'Laravel' => true,
                'Yii' => false,
                'Zend Framework' => false,
            ]
        );
        $this->createQuestion(
            $manager,
            $quiz,
            'What is the most recent PHP version?',
            [
                '7' => false,
                '8' => true,
                '9' => false,
            ]
        );

        $manager->persist($quizAuthor);
        $manager->persist($quiz);

        $manager->flush();
    }
}
