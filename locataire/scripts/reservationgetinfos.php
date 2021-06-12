<?php

require_once "../../scripts/connection.php";

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(isset($_POST['reservation_id']))
    {
        $reservation_id = $_POST['reservation_id'];
        $reservationQueery = " select
                                    nom,prenom,age,civilite,ville,
                                    marque,modele,annee,
                                    date_debut,date_fin,date_creation,
                                    (date_fin - date_debut) * prix_j prix_t,tel,etat
                                FROM
                                    reservation
                                JOIN vehicule USING(vehicule_id)
                                JOIN client USING(client_id)
                                WHERE
                                    reservation_id = $reservation_id;";

        if ($ReservationRes = $conn->query($reservationQueery)) 
        {
            $Reservation = $ReservationRes->fetch_assoc();
            if($Reservation['etat']!='Accepte')
            unset($Reservation['tel']);
            echo json_encode($Reservation);
        }
        else
            echo 1;
    }
    
}
else
    header('Location: ../../erreur/403.php');