<?php

namespace App\Form;

use App\Entity\Offre;
use Eckinox\TinymceBundle\Form\Type\TinymceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OffreForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('prix')
            ->add('description', TinymceType::class,[
                "attr" => [
                    "height" => "900",
                    "toolbar" => "undo redo | styles fontfamily fontsize backcolor | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullscreen | emoticons | help",
                    "plugins" => "advlist autolink lists link image charmap preview anchor pagebreak searchreplace visualblocks code fullscreen insertdatetime media table emoticons help",
                    "menubar" => "edit view insert format tools table help",
                    "images_upload_url" => "/tinymce/upload",
                    "automatic_uploads" => true,
                    "file_picker_types" => "image",
                    "relative_urls" => false,
                    "remove_script_host" => false,
                ]   
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Offre::class,
        ]);
    }
}
