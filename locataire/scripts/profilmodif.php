<?php

    require_once "../../scripts/connection.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {


        if( isset($_POST['locataire_id']) &&
            isset($_POST['nom'])          && isset($_POST['prenom'])        && 
            isset($_POST['tel'])          && isset($_POST['cin'])           &&  
            isset($_POST['civilite'])     && isset($_POST['age'])           && 
            isset($_POST['ville'])        && isset($_POST['code_postal'])   &&  
            isset($_POST['adresse'])      && isset($_POST['email'])     )
        {
            
            $locataire_id   = $_POST['locataire_id'];
            $nom            = $_POST['nom'];
            $prenom         = $_POST['prenom'];
            $tel            = $_POST['tel'];
            $cin            = $_POST['cin'];
            $civilite       = $_POST['civilite'];
            $age            = $_POST['age'];
            $ville          = $_POST['ville'];
            $code_postal    = $_POST['code_postal'];
            $adresse        = $_POST['adresse'];
            $email          = $_POST['email'];


            if($_FILES['locataire_image']['name'])
            {
                require_once 'profilajoutimage.php';
                $locataire_image = 'assets/img/ProfileImg/'.$image;       
                $UpdateLocataireRequete = " update locataire 
                                            set nom='$nom',prenom='$prenom',tel=$tel,cin='$cin',civilite='$civilite',age=$age,ville='$ville',code_postal=$code_postal,adresse='$adresse',email='$email',locataire_image='$locataire_image'
                                            where locataire_id = $locataire_id;";
            }
            else
            {
                $getImageQuuery = "select locataire_image from locataire where locataire_id = $locataire_id";

                if ($ImageResult = $conn->query($getImageQuuery))
                {
                    //------ ce traitement pour modifier le nom de l'image si le locataire change leur nom car on va avoir plusierus copie si on ne fait pas ca---------//
                    $ImageChemin = $ImageResult->fetch_assoc()['locataire_image'];
                    $extension = strrchr($ImageChemin, '.');
                    $locataire_image = substr($ImageChemin, 0, strrpos($ImageChemin, '/')).'/loc'.$locataire_id.'-'.$prenom.$nom.$extension;
                    rename("../../".$ImageChemin,"../../".$locataire_image);
                  
                }
                else
                    header('Location: ../../erreur/404.php');
                
                $UpdateLocataireRequete = " update locataire 
                                            set nom='$nom',prenom='$prenom',tel=$tel,cin='$cin',civilite='$civilite',age=$age,ville='$ville',code_postal=$code_postal,adresse='$adresse',email='$email',locataire_image='$locataire_image'
                                            where locataire_id = $locataire_id;";
            }
            

            if ($UpdateResult = $conn->query($UpdateLocataireRequete))
            {
               header('Location: ../profil.php?Notice=0');//modification avec succes
            }
            else
            {
               header('Location: ../profil.php?Notice=1');//erruer au moment de modification
            }
        }
        else
            header('Location: ../../erreur/404.php');

    }
    else
        header('Location: ../../erreur/403.php');

