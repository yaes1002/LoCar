<?php

    require_once "./connection.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if( isset($_POST['nom']) && isset($_POST['prenom'])  &&  isset($_POST['tel']) &&  
            isset($_POST['civilite']) && isset($_POST['age'])  && 
            isset($_POST['email']) && isset($_POST['mot_de_passe']) )
        {
            $nom         = $_POST['nom'];
            $prenom      = $_POST['prenom'];
            $tel         = $_POST['tel'];
            $civilite    = $_POST['civilite'];
            $age         = $_POST['age'];
            $email       = $_POST['email'];
            $mot_de_passe = sha1( $_POST['mot_de_passe']) ;
            
            $TestEmailExist = "select * from client where email = '$email' ;";
            $TestTelExist = "select * from client where tel = $tel ;";

            if ($EmailResultas = $conn->query($TestEmailExist) )
            {
                if($EmailResultas->num_rows != 0)
                {
                    header('Location: ../clientconnexion.php?NoticeS=1');
                    // 1-> Email Deja Exist Dans La Base 
                }
                else 
                {
                    
                    if ($TelResultas = $conn->query($TestTelExist))
                    {
                        if($TelResultas->num_rows != 0)
                            header('Location: ../clientconnexion.php?NoticeS=2');
                            // 2-> tel Deja Exist Dans La Base
                        else
                        {
                            //--------------------------Insertion d'un nouveau Locataire -----------------------------//
                            $InsertLocataireQuery = " insert into client (nom,prenom,tel,civilite,age,email,mot_de_passe)
                                                      values ('$nom','$prenom',$tel,'$civilite',$age,'$email','$mot_de_passe');";

                            if ($InsertResult = $conn->query($InsertLocataireQuery))
                            {
                                header('Location: ../clientconnexion.php?NoticeS=0');
                                // 0-> Insertion de locataire avec succes ";
                            }
                            else
                            {
                                header('Location: ../clientconnexion.php?NoticeS=3');
                                // 3-> Erreur au moment de l'insertion de Locataire dans la base
                            }
                        }
                    }
                    else
                    {
                        header('Location: ../erreur/404.php');
                        // 3-> Erreur au moment de la recherche de Tel dans la base
                    }
                }
                
            }
            else
            {
                header('Location: ../erreur/404.php');
                // 3-> Erreur au moment de la recherche de Email dans la base
            }
 
        }
        else
            header('Location: ../erreur/404.php');

    }
    else
    {
    
        header('Location: ../erreur/403.php');
        
    }

    



?>