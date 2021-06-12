<?php
    session_start();
    require_once "./connection.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if( isset($_POST['email']) && isset($_POST['mot_de_passe']) && !empty($_POST['email']) && !empty($_POST['mot_de_passe'])  )
        {

            function CleanString($str)
            {
                $str = trim($str);
                $str = stripslashes($str);
                $str = htmlspecialchars($str); 
                return $str;
            }

            $email        = CleanString($_POST['email']);
            $mot_de_passe = CleanString($_POST['mot_de_passe']);
            $mot_de_passe = sha1( $mot_de_passe) ;
            
            $TestAdmin    = "select * from admin where email     = '$email' and mot_de_passe = '$mot_de_passe';"; 
            $TestLocatire = "select * from locataire where email = '$email' and mot_de_passe = '$mot_de_passe';";
            $TestClient   = "select * from client where email    = '$email' and mot_de_passe = '$mot_de_passe';";

            //--------------- Test Locataire -------------------//
            if ( $AdminResultas = $conn->query($TestAdmin) )
            {
                if( $AdminResultas->num_rows == 1 )
                {
                    $row = $AdminResultas->fetch_array();
                    CreateSessionAndRedirecte( 'admin', $row );
                }
                else
                {
                    //--------------- Test Locataire -------------------//
                    if ( $LocataireResultas = $conn->query($TestLocatire) )
                    {
                        if($LocataireResultas->num_rows == 1)
                        {
                            $row = $LocataireResultas->fetch_array();
                            CreateSessionAndRedirecte( 'locataire', $row );
                        }
                        else
                        {
                            //--------------- Test Client -------------------//
                            if ( $ClientResultas = $conn->query($TestClient) )
                            {
                                if($ClientResultas ->num_rows == 1)
                                {
                                    $row = $ClientResultas->fetch_array();
                                    CreateSessionAndRedirecte( 'client', $row );
                                }
                                else
                                {
                                    if( strpos($_SERVER['HTTP_REFERER'],"locataire"))
                                        header('Location: ../locataireconnexion.php?Login=1&NoticeL=1');
                                    else
                                        header('Location: ../clientconnexion.php?Login=1&NoticeL=1');
                                        
                                }
                            }
                            else
                            {
                                header('Location: ../erreur/404.php');
                            }
                        }
                    }
                    else
                    {
                        header('Location: ../erreur/404.php');
                    }
                }
            }
            else
            {
                header('Location: ../erreur/404.php');
            }
        }
        else
        {
            if( strpos($_SERVER['HTTP_REFERER'],"locataire"))
                header('Location: ../locataireconnexion.php?Login=1&NoticeL=2');
            else
                header('Location: ../clientconnexion.php?Login=1&NoticeL=2');
        }

    }
    else
    {
       
        header('Location: ../erreur/403.php');
    }


    function CreateSessionAndRedirecte($role,$row)
    {
        $_SESSION['user']   = $role;
        $_SESSION['id']     = $row[0];
        $_SESSION['cin']    = $row[1];
        $_SESSION['nom']    = $row[2];
        $_SESSION['prenom'] = $row[3];
        
        header('Location: ../'.$role);

    }
    
    


?>