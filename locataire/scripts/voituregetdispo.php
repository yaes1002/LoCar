<?php

require_once "../../scripts/connection.php";

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(isset($_POST['vehicule_id']))
    {

        $vehicule_id = $_POST['vehicule_id'];

        $DisponibiliteRequete = " select DATE_FORMAT(date_debut, '%m/%d/%Y') as date_debut ,DATE_FORMAT(date_fin, '%m/%d/%Y')  as date_fin
                                  from disponibilite
                                  where vehicule_id = $vehicule_id";

        if ($DispoResults = $conn->query($DisponibiliteRequete)) 
        {
            $i = 0;
            while($Dispo = $DispoResults->fetch_assoc())
            {
            ?>
                
                <div class="mb-3 input-group intervaleCont<?php echo $i  ?>" >
                    <label class="input-group-text intervalLabel">La Durée <?php echo $i+1  ?> </label>
                    <input type="text" name="dispo[]" class="DispoDuree form-control TableFormInput" value="<?php  echo $Dispo['date_debut'].' - '.$Dispo['date_fin'] ?>" readonly required>
                    <label class="input-group-text suppIntervalCont" onclick='suppInterval(<?php echo $i  ?> )'><i class="fas fa-times suppInterval"></i></label>
                </div>
                    
            <?php
            $i++;
            } 
        }


    }
}
else
    header('Location: ../../erreur/403.php');