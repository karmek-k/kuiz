<?php

namespace App\Form;

use App\Entity\Question;
use App\Entity\QuestionAnswer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $questionName = $event->getData()->getName();
            $form = $event->getForm();

            $form
                ->add('questionAnswers', EntityType::class, [
                    'class' => QuestionAnswer::class,
                    'choice_label' => 'text',
                    'label' => $questionName,
                    'multiple' => true,
                    'expanded' => true,
                ]);
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
