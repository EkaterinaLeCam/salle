<?php

namespace Prereservation;

use App\Entity\PreReservation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PreReservationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PreReservation::class;
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
