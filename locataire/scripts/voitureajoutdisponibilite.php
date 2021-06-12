<?php


    require_once "../../scripts/connection.php";

    foreach ($dispos as $value) 
    {

        $date_debut =  substr($value,0,10);
        $date_fin   = substr($value,13);

        $InsertDispoRequete = " insert into disponibilite (date_debut,date_fin,vehicule_id)
                                values ( STR_TO_DATE('$date_debut','%m/%d/%Y'), STR_TO_DATE('$date_fin','%m/%d/%Y'), $vehicule_id )";                              

        if($InsertDispoRes = $conn->query($InsertDispoRequete))
        {
            //succes
        }

    }


?>
