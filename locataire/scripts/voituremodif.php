<?php

    require_once "../../scripts/connection.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        if( isset($_POST['vehicule_id']) &&
            isset($_POST['marque'])      && isset($_POST['modele'])         && 
            isset($_POST['couleur'])     && isset($_POST['kilometrage'])    &&  
            isset($_POST['gps'])         && isset($_POST['climat'])         && 
            isset($_POST['prix_j'])      && 
            isset($_POST['dispo'])  )
        {
            
            $vehicule_id    = $_POST['vehicule_id'];
            $marque         = $_POST['marque'];
            $modele         = $_POST['modele'];
            $couleur        = $_POST['couleur'];
            $kilometrage    = $_POST['kilometrage'];
            $gps            = $_POST['gps'];
            $climat         = $_POST['climat'];
            $prix_j         = $_POST['prix_j'];

            $dispos         = $_POST['dispo'];


            if($_FILES['vehicule_image']['name'])
            {
                require_once 'voitureajoutimage.php';
                $vehicule_image = 'assets/img/CarImages/'.$image;       
                $UpdateVoitureRequete = " update vehicule 
                                          set couleur='$couleur',kilometrage=$kilometrage,gps='$gps',climat='$climat',prix_j=$prix_j,vehicule_image='$vehicule_image' 
                                          where vehicule_id = $vehicule_id;";
            }
            else
            {
                $UpdateVoitureRequete = " update vehicule 
                                          set couleur='$couleur',kilometrage=$kilometrage,gps='$gps',climat='$climat',prix_j=$prix_j
                                          where vehicule_id = $vehicule_id;"; 
            }

            

            if ($UpdateResult = $conn->query($UpdateVoitureRequete))
            {
                $DeleteDispoRequete = " delete from disponibilite
                                        where vehicule_id = $vehicule_id ;";
                                
                if($DeleteDispoRes = $conn->query($DeleteDispoRequete))
                require_once 'voitureajoutdisponibilite.php';

                header('Location: ../voitures.php?Notice=0&Fct=Modification');//modification avec succes
                
            }
            else
            {
                header('Location: ../voitures.php?Notice=1&Fct=%20Modification');//modification avec succes
            }
        }
        else
            header('Location: ../../erreur/404.php');

        

    }
    else
        header('Location: ../../erreur/403.php');

