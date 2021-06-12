<?php

    require_once "../../scripts/connection.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if( isset($_POST['id']) )
        {
            
            $id      = $_POST['id'];
            $GetPicQueery =  "  select client_image image,nom, prenom 
                                from client
                                where client_id = $id ;";
                
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

