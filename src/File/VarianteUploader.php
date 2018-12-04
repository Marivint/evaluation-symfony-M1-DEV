<?php

namespace App\File;

use App\Entity\Variante;

class VarianteUploader{

    public function __construct(string $directory)
    {
        $this->directory = $directory;
    }

    public function upload(Variante $v)
    {
        // this->getParameter('dossier_variantes')
        if(null !== $image =  $v->getImage()){
            $fileName = md5(uniqid()).'.'.$image->guessExtension();
            $image->move($this->directory, $fileName);
            $v->setFilename($fileName);
        }

    }
}