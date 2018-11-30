<?php

namespace App\Form {

    use App\Entity\Variante;
    use Symfony\Component\Form\AbstractType;

    use Symfony\Component\Form\Extension\Core\Type\FileType;
    use Symfony\Component\Form\Extension\Core\Type\IntegerType;
    use Symfony\Component\Form\Extension\Core\Type\NumberType;
    use Symfony\Component\Form\Extension\Core\Type\TextType;

    use Symfony\Component\Form\Extension\Core\Type\UrlType;
    use Symfony\Component\Form\FormBuilderInterface;

    class VarianteForm extends AbstractType{
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
                ->add('intitule', TextType::class, ['label' => 'Intitulé de la variante'])
                ->add('description', TextType::class, ['label' => 'Description'])
                ->add('prix', IntegerType::class, ['label' => 'Description'])
                ->add('src_image', FileType::class, ['label' => 'Image'])
                ->getForm();
        }
    }
}
