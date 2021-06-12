<?php

    require_once "../../scripts/connection.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if( isset($_POST['id']) )
        {
            
            $id      = $_POST['id'];
            $GetPicQueery =  "  select locataire_image image, nom, prenom 
                                from locataire
                                where locataire_id = $id ;";
                
            if ($Res = $conn->query($GetPicQueery)) 
            {
                $user = $Res->fetch_assoc();
                echo json_encode($user);
            }
            
        }
        else
            header('Location: ../../erreur/404.php');
    }
    else
        header('Location: ../../erreur/403.php');

