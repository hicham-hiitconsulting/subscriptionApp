<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Helpers\SecurityHelper;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

/**
 * Class UserCrudController.
 */
class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function createEntity(string $entityFqcn): User
    {
        $user = new User();
        $user->setRoles([SecurityHelper::ROLE_USER]);

        return $user;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('firstname', 'First Name'),
            TextField::new('lastname', 'Last Name'),
            TextField::new('phone', 'Phone'),
            EmailField::new('email', 'Email'),
            TextField::new('password', 'Password')->setFormType(PasswordType::class)->hideOnIndex()->hideOnDetail(),
            ChoiceField::new('roles')->setChoices(
                [
                    SecurityHelper::ROLE_USER  => SecurityHelper::ROLE_USER,
                    SecurityHelper::ROLE_ADMIN => SecurityHelper::ROLE_ADMIN,
                ]
            )->allowMultipleChoices(),

        ];
    }
}
