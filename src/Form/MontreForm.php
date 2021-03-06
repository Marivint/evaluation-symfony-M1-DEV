<?php

namespace App\Form {

    use Symfony\Component\Form\AbstractType;

    use Symfony\Component\Form\Extension\Core\Type\TextType;

    use Symfony\Component\Form\FormBuilderInterface;

    class MontreForm extends AbstractType{
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
                ->add('intitule', TextType::class, ['label' => 'Intitulé de la montre'])
                ->add('description', TextType::class, ['label' => 'Description'])
                ->getForm();
        }
    }
}
