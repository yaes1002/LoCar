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
            if($DispoResults->num_rows < 1)
            {
              ?>
                <div class="mb-3 input-group NoDispoNotice" >
                  <div class="alert myAlert alert-warning alert-dismissible fade show mt-2 animate__animated animate__bounceIn" role="alert">
                    <i class="fas fa-check-circle"></i>
                    <strong>Attention: </strong> Cette voiture n'est pas Disponible pour l'instant
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                </div>
              <?php
            }


            $i = 0;
            while($Dispo = $DispoResults->fetch_assoc())
            {
            ?>
                
                <div class="mb-3 input-group intervaleCont" >
                    <label class="input-group-text intervalLabel">La Durée <?php echo $i+1  ?> </label>
                    <input type="text" class="DispoDuree form-control TableFormInput" value="<?php  echo $Dispo['date_debut'].' - '.$Dispo['date_fin'] ?>" readonly required>
                </div>
                    
            <?php
            $i++;
            } 
        }


    }
}
else
    header('Location: ../../erreur/403.php');

?>