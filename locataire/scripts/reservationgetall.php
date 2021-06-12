<?php

require_once "../../scripts/connection.php";

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(isset($_POST['locataire_id']))
    {
        $locataire_id = $_POST['locataire_id'];
        $reservationAffichageQueery = " select *,(date_fin - date_debut)*prix_j prixT
                                        from reservation join vehicule
                                        using (vehicule_id)
                                        where locataire_id = $locataire_id
                                        and visibilite = 'Oui'
                                        and etat not in ('Refuse','Annule')
                                        order by etat;";

        if ($tableContenu = $conn->query($reservationAffichageQueery)) 
        {
            while ($row = $tableContenu->fetch_assoc()) 
            {
                ?>
                    <tr class="item">
                    <td> <?php echo "".$row['reservation_id']?></td>
                    <td> <?php echo ucwords($row['marque']." ".$row['modele'])?></td>
                    <td class="prixt"> <?php echo $row['prixT'].' MAD'?></td>
                    <td> <?php echo $row['date_debut']?></td>
                    <td> <?php echo $row['date_fin']?></td>
                    <td> <?php echo $row['date_creation']?></td>
                    <td class="etat"> 
                        <?php 
                            switch($row['etat']) 
                            {
                            case "En attente":
                                ?>
                                <span class="EtatIcon AttenteIcon" title="En Attente">  
                                    <i class="fas fa-clock" ></i>
                                </span> 
                                <span class="abbr">E</span>
                                <?php
                            break;
                            case "Accepte":
                                ?>
                                <span class="EtatIcon AccepteIcon" title="Accepté">  
                                    <i class="fas fa-check-circle"></i>
                                </span>
                                <span class="abbr">A</span> 
                                <?php
                            break;
                            }
                        ?>
                    </td>
                    <td class="action"> 
                        <i class="fad fa-search ActionIcon Afficher" title="Afficher plus d'informations" onclick="AfficherInfosClick('<?php echo $row['reservation_id']  ?>')" ></i>
                        <?php
                        if($row['etat']=='En attente')
                        {
                        ?>
                            <i class="fas fa-check ActionIcon Accepter"  onclick="AcceptReserv('<?php echo $row['reservation_id']  ?>','<?php echo $locataire_id  ?>'),AccepterClick()" title="Accepter"></i>
                            <i class="fad fa-times ActionIcon Refuser" onclick="RefuseReserv('<?php echo $row['reservation_id']  ?>','<?php echo $locataire_id  ?>'),refuserClick()"  title="Refuser"></i>
                      <?php
                        }
                        ?>
                    </td>
                    </tr> 
                <?php
                
            }
        }
    }
    
}
else
    header('Location: ../../erreur/403.php');