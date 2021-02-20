<?php

namespace App\Controller\Admin;

use App\Entity\QuestionAnswer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class QuestionAnswerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return QuestionAnswer::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
