<?php

    require_once "./connection.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if( isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['sujet']) && isset($_POST['message']) )
        {
            $nom=$_POST['nom'];
            $prenom=$_POST['prenom'];
            $email=$_POST['email'];
            $sujet=$_POST['sujet'];
            $message=$_POST['message'];
            

            if(!empty($_POST['tel']))
            {
                $tel=$_POST['tel'];
                $InsertMessageQuery = " insert into message (nom,prenom,email,tel,sujet,message_text)
                                        values ('$nom','$prenom','$email',$tel,'$sujet','$message');";
            }
            else
            {
                $InsertMessageQuery = " insert into message (nom,prenom,email,sujet,message_text)
                                        values ('$nom','$prenom','$email','$sujet','$message');";
            }
            
    
            if ($tableContenu = $conn->query($InsertMessageQuery))
            {
                header('Location: ../contact-us/?err=0');
            }
            else
            {
                header('Location: ../contact-us/?err=1');
            }
                        
        }
    }
    else
    {
        header('Location: ../erreur/403.php');
    }


?>