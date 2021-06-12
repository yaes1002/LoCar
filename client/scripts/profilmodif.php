<?php

    require_once "../../scripts/connection.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if( isset($_POST['client_id']) &&
            isset($_POST['nom'])          && isset($_POST['prenom'])        && 
            isset($_POST['tel'])          && isset($_POST['cin'])           &&  
            isset($_POST['civilite'])     && isset($_POST['age'])           && 
            isset($_POST['ville'])        && isset($_POST['email'])    && 
            isset($_POST['code_postal'])  && isset($_POST['adresse'])    )
        {
            
            $client_id      = $_POST['client_id'];
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


            if($_FILES['client_image']['name'])
            {
                require_once 'profilajoutimage.php';
                $client_image = 'assets/img/ProfileImg/'.$image;       
                $UpdateClientRequete = " update client 
                                        set nom='$nom',prenom='$prenom',tel=$tel,cin='$cin',civilite='$civilite',age=$age,ville='$ville',code_postal=$code_postal,adresse='$adresse',email='$email',client_image='$client_image'
                                        where client_id = $client_id;";
                                          
            }
            
            else
            {
                $getImageQuuery = "select client_image from client where client_id = $client_id";

                if ($ImageResult = $conn->query($getImageQuuery))
                {
                    //------ ce traitement pour modifier le nom de l'image si le client change leur nom car on va avoir plusierus copie si on ne fait pas ca---------//
                    $ImageChemin = $ImageResult->fetch_assoc()['client_image'];
                    $extension = strrchr($ImageChemin, '.');
                    $client_image = substr($ImageChemin, 0, strrpos($ImageChemin, '/')).'/cl'.$client_id.'-'.$prenom.$nom.$extension;
                    rename("../../".$ImageChemin,"../../".$client_image);
                  
                }
                else
                    header('Location: ../../erreur/404.php');
                
                $UpdateClientRequete = " update client 
                                            set nom='$nom',prenom='$prenom',tel=$tel,cin='$cin',civilite='$civilite',age=$age,ville='$ville',code_postal=$code_postal,adresse='$adresse',email='$email',client_image='$client_image'
                                            where client_id = $client_id;";
            }
            
            if ($UpdateResult = $conn->query($UpdateClientRequete))
            {
               header('Location: ../profil.php?Notice=0');//modification avec succes
            }
            else
            {
                header('Location: ../profil.php?Notice=1');//modification avec error
            }
        }
        else
            header('Location: ../../erreur/404.php');

        

    }
    else
        header('Location: ../../erreur/403.php');

