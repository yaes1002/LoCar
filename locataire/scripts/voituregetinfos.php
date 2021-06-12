<?php

require_once "../../scripts/connection.php";

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(isset($_POST['vehicule_id']))
    {

        $vehicule_id = $_POST['vehicule_id'];
        $voitureRequete = " select *
                            from vehicule
                            where vehicule_id = $vehicule_id ;";

        if ($voitureRes = $conn->query($voitureRequete)) 
        {
            $voiture = $voitureRes->fetch_assoc();
            echo json_encode($voiture);
        }
    }
}
else
    header('Location: ../../erreur/403.php');