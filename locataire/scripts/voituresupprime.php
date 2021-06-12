<?php

    require_once "../../scripts/connection.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        if( isset($_POST['vehicule_id'])  )
        {
            
            $vehicule_id    = $_POST['vehicule_id'];
      
            $DeleteDispoRequete = " delete from disponibilite
                                    where vehicule_id = $vehicule_id;";

            if ($DeleteResult = $conn->query($DeleteDispoRequete)) 
            {
                $UpdateVoitureRequete = " update vehicule 
                                          set visibilite = 'Non',matricule = CONCAT(matricule, vehicule_id) 
                                          where vehicule_id = $vehicule_id; ";

                if ($UpdateResult = $conn->query($UpdateVoitureRequete))
                {  
                    header('Location: ../voitures.php?Notice=0&Fct=%20Suppression');//suppression avec succes
                }
                else
                {
                    header('Location: ../voitures.php?Notice=1&Fct=%20Suppression');//suppression avec succes
                }
            }
            else
                echo '3-> Erreur au moment de delete dispo dans la base';//on va creer un alert
        } 
        else
            header('Location: ../../erreur/404.php');

    }
    else
        header('Location: ../../erreur/403.php');

