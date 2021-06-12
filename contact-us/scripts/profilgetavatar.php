<?php

    require_once "../../scripts/connection.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if( isset($_POST['id']) && isset($_POST['user']) )
        {
            
            $id      = $_POST['id'];
            $user      = $_POST['user'];
            $user_id = $user."_id";
            $user_image = $user."_image";
            
            $GetPicQueery =  "  select $user_image image, nom, prenom
                                from $user
                                where $user_id = $id ;";
                
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

