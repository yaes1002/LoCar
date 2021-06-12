<?php

    require_once "../../scripts/connection.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        echo "<pre>";
        print_r($_POST);
        echo "</pre>";
        if( isset($_POST['client_id']) && isset($_POST['ancienmdp']) && isset($_POST['nouveaumdp']) && isset($_POST['confirmmdp'])  )
        {
            
            $client_id   =   $_POST['client_id'] ;
            $ancienmdp      =  sha1($_POST['ancienmdp'])    ;
            $nouveaumdp     =  sha1($_POST['nouveaumdp'] )  ;
            $confirmmdp     =  sha1($_POST['confirmmdp']  ) ;

            if( strcmp( $nouveaumdp   , $confirmmdp )==0 )
            {
                $TestPassword = "select mot_de_passe from client where client_id = $client_id ;";
                if ($TestResultat = $conn->query($TestPassword))
                {
                    $ligne = $TestResultat->fetch_assoc();
                    
                    if( strcmp( $ligne['mot_de_passe'] , $ancienmdp )==0   )
                    {
                        $UpdatePassword = "update client set mot_de_passe = '$nouveaumdp' where client_id = $client_id ;";
                        if ($UpdateResultat = $conn->query($UpdatePassword))
                        {
                            header('Location: ../profil.php?Npass=0');//different Nv pass
                        }
                        else
                            header('Location: ../../erreur/404.php');

                    }
                    else
                        header('Location: ../profil.php?Npass=2');//different ancien pass
                }
                else
                    header('Location: ../../erreur/404.php');
                
            }
            else
                header('Location: ../profil.php?Npass=1');//different Nv pass
      
        }
        else
            header('Location: ../../erreur/404.php');

    }
    else
        header('Location: ../../erreur/403.php');

