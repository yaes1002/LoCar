<?php

    require_once "../../scripts/connection.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if( isset($_POST['id']) )
        {
            
            $id      = $_POST['id'];
            $user    = $_POST['user'];
            $user_id = $user."_id";
            $GetPicQueery =  "  select * 
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

