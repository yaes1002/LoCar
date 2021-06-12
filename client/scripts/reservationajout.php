<?php

    require_once "../../scripts/connection.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if( isset($_POST['vehicule_id'])  && isset($_POST['client_id'])   &&
            isset($_POST['date_debut'])  && isset($_POST['date_fin'])        )
        {
            
            $vehicule_id    = $_POST['vehicule_id'];
            $client_id      = $_POST['client_id'];
            $date_debut    = $_POST['date_debut'];
            $date_fin      = $_POST['date_fin'];

            $TestReservExistQueery = "select DATE_FORMAT(date_debut, '%m/%d/%Y') date_debut,DATE_FORMAT(date_fin, '%m/%d/%Y') date_fin from reservation where vehicule_id = $vehicule_id and client_id = $client_id and etat = 'En attente'; ";
            
            if ($ReservResult = $conn->query($TestReservExistQueery))
            {
                $valide = true;
                while($reservation = $ReservResult->fetch_assoc())
                {
                    if( $reservation['date_debut'] == $date_debut &&  $reservation['date_fin'] == $date_fin )
                    $valide = false;
                }

                if($valide)
                {

                    $deleteOldReservQueery = "delete from reservation 
                                              where vehicule_id = $vehicule_id
                                              and client_id = $client_id  
                                              and etat = 'En attente';";
                    if($DeleteResult = $conn->query($deleteOldReservQueery))
                    {
                        $InsertReservRequete = " insert into reservation (vehicule_id,date_debut,date_fin,client_id,date_creation )
                                                values ($vehicule_id, STR_TO_DATE('$date_debut','%m/%d/%Y'),STR_TO_DATE('$date_fin','%m/%d/%Y'),$client_id, SYSDATE());";

                        if ($InsertResult = $conn->query($InsertReservRequete))
                            echo 0;
                        else
                            echo 1;
                        
                    }
                    else
                        echo 1;
                }
                else
                    echo 2;     
            }
            else
                echo 1;
        }
        else
            echo 1;
    }
    else
        header('Location: ../../erreur/403.php');
    

    



?>