<?php
    $image = basename($_FILES['vehicule_image']['name']);
    $chemin = '../../assets/img/CarImages/';

    $extensions = array('.png', '.gif', '.jpg', '.jpeg');
    $extension = strrchr($_FILES['vehicule_image']['name'], '.');

    if(!in_array($extension, $extensions))
    {
        $erreur = 'Vous devez uploader un fichier de type png, gif, jpg ou jpeg...';
    }
    
    if(!isset($erreur)) 
    {

        $image = $marque.$modele.$vehicule_id.$extension;
        $image = strtr($image,'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ','AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
        $image = preg_replace('/([^.a-z0-9]+)/i', '-', $image);
        //$image = strstr($image,$extension,true).$vehicule_id.$extension; 
        if (file_exists($chemin.$image)) 
        {
            chmod($chemin.$image,0755); //Change the file permissions if allowed
            unlink($chemin.$image); //remove the file
        }
        
        if(move_uploaded_file($_FILES['vehicule_image']['tmp_name'], $chemin.$image))
        {
            // upload image avec succes<br>';
        }
        else
        {
            //error
        }
    }

?>
