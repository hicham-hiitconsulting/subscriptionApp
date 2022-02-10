<?php

namespace App\Controller\Admin;

use App\Entity\PaymentDetails;
use App\Helpers\CardType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

/**
 * Class PaymentDetailsCrudController.
 */
class PaymentDetailsCrudController extends AbstractCrudController
{
    /**
     * @return string
     */
    public static function getEntityFqcn(): string
    {
        return PaymentDetails::class;
    }

    /**
     * @param Crud $crud
     *
     * @return Crud
     */
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Payment')
            ->setEntityLabelInPlural('Payments');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('cardHolderName', 'Card Holder Name'),
            ChoiceField::new('cardType', 'Card Type')->setChoices([
                CardType::TYPE_VISA        => CardType::TYPE_VISA,
                CardType::TYPE_MASTER_CARD => CardType::TYPE_MASTER_CARD,
            ]),
            TextField::new('cardNum', 'Card Number'),
            DateTimeField::new('cardExpiry', 'Card Expiry Date'),
            AssociationField::new('user', 'Subscriber'),
        ];
    }
}
