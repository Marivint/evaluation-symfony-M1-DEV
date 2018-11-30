<?php

namespace App\Form {

    use App\Entity\Variante;
    use Symfony\Bridge\Doctrine\Form\Type\EntityType;
    use Symfony\Component\Form\AbstractType;

    use Symfony\Component\Form\Extension\Core\Type\IntegerType;
    use Symfony\Component\Form\Extension\Core\Type\NumberType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;

    use Symfony\Component\Form\Extension\Core\Type\UrlType;
    use Symfony\Component\Form\FormBuilderInterface;

    class MontreForm extends AbstractType{
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
                ->add('intitule', TextType::class, ['label' => 'Intitulé de la montre'])
                ->add('description', TextType::class, ['label' => 'Description'])
                ->add('variantes', EntityType::class,[
                    'class' => Variante::class,
                    'choice_label' => 'intitule',
                    'multiple' => true
                ])
                ->getForm();
        }
    }
}
