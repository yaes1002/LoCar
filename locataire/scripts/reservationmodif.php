<?php

    require_once "../../scripts/connection.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if( isset($_POST['reservation_id']) &&  isset($_POST['modification'])      )
        {
            
            $reservation_id    = $_POST['reservation_id'];
            $modification      = $_POST['modification'];

            $UpdateReservQueery = " update reservation 
                                    set etat = '$modification'
                                    where reservation_id = $reservation_id";
            
            if ($ReservResult = $conn->query($UpdateReservQueery))
            {
                echo 0;     
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