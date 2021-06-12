<?php

    require_once "../../scripts/connection.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        if( isset($_POST['marque'])       && isset($_POST['modele'])         &&    
            isset($_POST['annee'])        && isset($_POST['matricule'])      && 
            isset($_POST['couleur'])      && isset($_POST['boite_vitesse'])  && 
            isset($_POST['kilometrage'])  && isset($_POST['energie'])        && 
            isset($_POST['nbr_places'])   && isset($_POST['nbr_portes'])     && 
            isset($_POST['gps'])          && isset($_POST['climat'])         && 
            isset($_POST['prix_j'])       && isset($_POST['locataire_id'])   &&
            isset($_POST['dispo'])   )
        {
            
            $matricule      = $_POST['matricule'];
            $marque         = $_POST['marque'];
            $modele         = $_POST['modele'];
            $annee          = $_POST['annee'];
            $couleur        = $_POST['couleur'];
            $boite_vitesse  = $_POST['boite_vitesse'];
            $kilometrage    = $_POST['kilometrage'];
            $energie        = $_POST['energie'];
            $nbr_places     = $_POST['nbr_places'];
            $nbr_portes     = $_POST['nbr_portes'];
            $gps            = $_POST['gps'];
            $climat         = $_POST['climat'];
            $prix_j         = $_POST['prix_j'];
            $locataire_id   = $_POST['locataire_id'];

            $dispos         = $_POST['dispo'];
            

            //-------------Get Last Vehicule ID--------------------//
            
            $LatestVehiculeIdRequete = "select AUTO_INCREMENT
                                        from information_schema.TABLES
                                        where TABLE_SCHEMA = 'locar'
                                        and TABLE_NAME = 'vehicule';";
            $VehiculeResult = $conn->query($LatestVehiculeIdRequete);
            $vehicule = $VehiculeResult->fetch_array(); 
            $vehicule_id = $vehicule[0];

            echo 'vehicule id = '.$vehicule_id.'<br>';
            
            //----------------------------------------------//

            require_once 'voitureajoutimage.php';

            $vehicule_image = 'assets/img/CarImages/'.$image;
            
            $InsertVoitureRequete = " insert into vehicule (matricule,marque,modele,annee,couleur,boite_vitesse,kilometrage,energie,nbr_places,nbr_portes,gps,climat,prix_j,vehicule_image,locataire_id )
                                      values ('$matricule','$marque','$modele',$annee,'$couleur','$boite_vitesse',$kilometrage,'$energie',$nbr_places,$nbr_portes,'$gps','$climat',$prix_j,'$vehicule_image',$locataire_id);";

            if ($InsertResult = $conn->query($InsertVoitureRequete))
            {
                // create disponibilite
                require_once 'voitureajoutdisponibilite.php';
                header('Location: ../voitures.php?Notice=0&Fct=Ajout');//ajout avec succes
            }
            else
            {
                header('Location: ../voitures.php?Notice=1&Fct=jout');//ajout avec succes
            }
        }
        else
            header('Location: ../../erreur/404.php');

    }
    else
    {
        header('Location: ../../erreur/403.php');
    }

    



?>