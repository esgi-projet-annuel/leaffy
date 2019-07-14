<?php
declare(strict_types = 1);

namespace LeaffyMvc\Controllers;

use LeaffyMvc\Core\View;
use LeaffyMvc\Models\Media;

class MediaController
{
    public function showAll():void{
        $view= new View('media', 'back');
    }

    public function addMedia(): void {
        var_dump($_POST);
        var_dump($_FILES);

        $path_parts = pathinfo($_FILES['files']['name'][0]);
        $fileName = uniqid() . '.' .  $path_parts['extension'];
        $filePath = '/var/www/html/medias/' . $fileName;

        move_uploaded_file($_FILES['files']['tmp_name'][0], $filePath);

        $media = new Media();
        $media->setType($_FILES['files']['type'][0]);
        $media->setPath($filePath);
        $media->save();

    }

}